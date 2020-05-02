# Тупой я круто сьел английского деда
# pronoun proadj    adv verb   adj noun
import random

import amb

from gtts import gTTS
from fuzzywuzzy import fuzz
# from fuzzywuzzy import process

# import speech_recognition as sr
#   pip install pysoundfile
from os import path
import os
# import soundfile as sf

pronoun = []
proadj = []

verb = []
adv = []

noun = []
adj = []

#prts = [   0   ,   1   ,  2  ,  3 ,   4 ,  5 ]
parts = [pronoun, proadj, verb, adv, noun, adj]
parts_str = ['pronoun', 'proadj', 'verb', 'adv', 'noun', 'proadj']
templates = [[2,'нахуй'],[0,'нe ','fmt%1','pick%0',2],[0,'fmt%3','pick%0', 1],['Ты ', 1],[0,'fmt%3','pick%0',1,3,'fmt%2','pick%0',2],[0,'l%1',', как ',0,'l%1',', тоже ','fmt%3','pick%0',1]]
#templates = [[0,'нe ','fmt%1','pick%0',2]]

# Туториал по темплейтам:
#  - Циферки(от 0 до 5) означают часть речи(совместимы с массивом parts_str). Просто рандомно вставляются в слово из базы
#  - Текст вставляется в сообщение на прямую. Пробел перед ним не требуется, после если идет слово то он нужен
#  - Конструкции fmt% форматируют следующую часть темлейта через функцию formatword(). В самой функции в зависимости от индекса после конструкции
#    изменяется следующее слово в темплейте
#  - Конструкции pick% находят род у слова в темплейте по индексу в конструкции. Полученное значение применяется через fmt на следующем слове
#  - Конструкции l% укорачивают уже сгенерированное сообщение на количество, указанное в конструкции (Например, что-бы убрать пробел перед запятой)

# 
# [1] Инициализация
# 

def initialize():
	for i in range(len(parts)):
		f = open("conmes/"+parts_str[i]+".txt", "r",encoding='utf-8')
		desplit = f.read().replace('\n',' ').split(' ')

		for m in range(len(desplit)):
			if (desplit[m] != '') and (desplit[m] != ' '):
				parts[i].append(desplit[m])

		amb.log('[CMS] Initializing parts ['+str(i+1)+'/'+str(len(parts))+']','system')
		#print('[CMS] parts[i]: '+str(parts[i])+', parts_str[i]: '+str(parts_str[i]))
		f.close()


keys = []
replies = []

def initialize_taggen():
	f = open("conmes/tags.txt", "r", encoding = 'utf-8')
	lines = f.readlines()
	amb.log('[CMS] Initializing tags ['+str(len(lines))+']','system')
	f.close()

	for i in range(len(lines)):
		splt = lines[i].replace('\n','').split(':')
		key = splt[0][0:len(splt[0])-1]
		line = splt[1][2:len(splt[1])-2]
		line = line.split('","')

		keys.append(key)
		replies.append(line)

	# if config.v_eat_logs_taggen == 1:
	# 	eat_logs_taggen()
	# 	write_keys_taggen()

smatch_keystrings = []
smatch_matches = []
smatch_rates = []
lastind = -1
lasttype = -1

def initialize_smatch():
	f = open("conmes/smatch.txt", "r", encoding = 'utf-8')
	lines = f.readlines()
	amb.log('[CMS] Initializing smatch ['+str(len(lines))+']','system')
	f.close()

	for i in range(len(lines)):
		ind = lines[i].find('" : "')
		if (ind != -1):
			smatch_keystrings.append(lines[i][1:ind])
			smatch_matches.append(lines[i][ind+5:len(lines[i])-7])
			# print(lines[i][len(lines[i])-5:len(lines[i])])
			# print(str(i))
			smatch_rates.append(int(lines[i][len(lines[i])-5:len(lines[i])]))

	# print(str(smatch_rates))
	# if config.v_eat_logs_smatch == 1:
	# 	eat_logs_smatch()
	# 	# for i in range(len(smatch_keystrings)):
	# 	# 	smatch_rates.append(0)
	# 	save_smatch()


# P.S. Функции выше запускаются в самом низу

# 
# [2] Система нечеткого сравнения - smatch
# 
def find_smatch(text):
	global lastind
	global lasttype

	ctext = amb.eliminate_all(text.lower(),[',','.','!','?'])
	maxsmatch = 0
	maxmatches = []
	maxindexes = []
	print(str(lastind))
	for i in range(len(smatch_keystrings)):
		cursmatch = fuzz.ratio(ctext, amb.eliminate_all(smatch_keystrings[i].lower(),[',','.','!','?'])) + smatch_rates[i]
		if cursmatch >= maxsmatch:
			if cursmatch != maxsmatch:
				maxmatches = [smatch_matches[i]]
				maxindexes = [i]
				maxsmatch = cursmatch
			elif (cursmatch == maxsmatch):
				maxmatches.append(smatch_matches[i])
				maxindexes.append(i)
			

	print(maxsmatch)
	print(str(maxmatches))
	if (maxsmatch > 50):
		ind = random.randint(0,len(maxmatches)-1)
		lastind = maxindexes[ind]
		lasttype = 'smatch'
		# return maxmatches[ind]+' ('+str(maxsmatch)+')'
		return maxmatches[ind]
	else:
		lastind = -1
		lasttype = -1
		return check_tags(text)
		
def correct_smatch(arg, over100 = 0):
	if lasttype == 'smatch':
		if lastind != -1:
			amb.log('[CMS] Smatch reaction correcting... lastind = '+str(lastind)+', key = '+smatch_keystrings[lastind],'system')
			smatch_rates[lastind] = smatch_rates[lastind] + arg*10
			if (smatch_rates[lastind] > 100) and (over100 == 0):
				smatch_rates[lastind] = 100
			if (smatch_rates[lastind] > 160) and (over100 == 1):
				smatch_rates[lastind] = 160

			save_smatch()
		else:
			amb.log('[CMS] Smatch reaction not corrected! No lastind','system')
	elif (lasttype == 'taggen') or (lasttype == 'parts'):
		amb.log('[CMS] Adding to smatch '+lasttype+' and correcting... keystring = '+lastind[0]+', match = '+lastind[1],'system')
		smatch_keystrings.append(lastind[0])
		smatch_matches.append(lastind[1])
		smatch_rates.append(arg*10)

		save_smatch()
	else:
		amb.log('[CMS] Smatch reaction not corrected! No lasttype','system')

def eat_logs_smatch():
	files = os.listdir('./content')
	print(str(files))
	for i in range(len(files)):
		if (files[i].find('.log') != -1) and (files[i] != 'system.log'):
			# print(str(i))
			f = open("content/"+files[i], "r")
			lines = f.readlines()

			f.close()
			# print(lines)
			process_lines_smatch(lines)

def process_lines_smatch(lines):
	for m in range(1,len(lines)):
		ind_a1 = lines[m-1].find('message sent: "')
		if (ind_a1 == -1) and (lines[m-1].find('veronika sent: "') != -1):
			ind_a1 = lines[m-1].find('veronika sent: "')
		ind_a2 = lines[m-1].find('from: ')
		ind_b1 = lines[m].find('message sent: "')
		ind_b2 = lines[m].find('from: ')
		if (ind_a1 != -1) and (ind_a2 != -1) and (ind_b1 != -1) and (ind_b2 != -1) and (lines[m].find('message sent: SpecialType,') == -1):
			ind_a1 = lines[m-1].find('"',ind_a1,ind_a2)+1
			d = ind_a2
			while lines[m-1][d] != '"':
				d-=1
			ind_a2 = d

			ind_b1 = lines[m].find('"',ind_b1,ind_b2)+1
			d = ind_b2
			while lines[m][d] != '"':
				d-=1
			ind_b2 = d

			str1 = lines[m-1][ind_a1:ind_a2].replace('@depozzya_bot ','').replace('@depozzya_bot','')
			str2 = lines[m][ind_b1:ind_b2].replace('@depozzya_bot ','').replace('@depozzya_bot','')
			if len(str1)>=1:
				if (str1[len(str1)-1]) == ')':
					if amb.if_instanses_exists_str(str1,['(100)','(110)','(120)','(130)','(140)','(150)','(160)']) == 1:
						str1 = str1[0:len(str1)-6]
					else:
						str1 = str1[0:len(str1)-5]
			if len(str2)>=1:
				if (str2[len(str2)-1]) == ')':
					if amb.if_instanses_exists_str(str2,['(100)','(110)','(120)','(130)','(140)','(150)','(160)']) == 1:
						str2 = str2[0:len(str2)-6]
					else:
						str2 = str2[0:len(str2)-5]


			found = 0
			for i in range(len(smatch_keystrings)):
				if (smatch_keystrings[i] == str1) and (smatch_matches[i] == str2):
					found = 1
					break

			if found == 0:
				smatch_keystrings.append(str1)
				smatch_matches.append(str2)
				smatch_rates.append(0)

def save_smatch():
	# print(smatch_keystrings)
	amb.log('[CMS] Saving smatch...','system')
	f = open("conmes/smatch.txt", "w", encoding = 'utf-8')
	line = ''
	for i in range(len(smatch_keystrings)):
		line = line + '\n"' + smatch_keystrings[i] + '" : "' + smatch_matches[i] + '" '+str(smatch_rates[i]).zfill(4)
	f.write(line)
	f.close()
	amb.log('[CMS] Smatch saved.','system')

# 
# [3]  Система тегов - taggen
# 

def eat_logs_taggen():
	files = os.listdir('./content')
	print(str(files))
	for i in range(len(files)):
		if (files[i].find('.log') != -1) and (files[i] != 'system.log'):
			f = open("content/"+files[i], "r")
			lines = f.readlines()
			f.close()

			for m in range(1,len(lines)):
				ind_a1 = lines[m-1].find('message sent: "')
				if (ind_a1 == -1) and (lines[m-1].find('veronika sent: "') != -1):
					ind_a1 = lines[m-1].find('veronika sent: "')
				ind_a2 = lines[m-1].find('from: ')
				ind_b1 = lines[m].find('message sent: "')
				ind_b2 = lines[m].find('from: ')
				if (ind_a1 != -1) and (ind_a2 != -1) and (ind_b1 != -1) and (ind_b2 != -1) and (lines[m].find('message sent: SpecialType,') == -1):
					ind_a1 = lines[m-1].find('"',ind_a1,ind_a2)+1
					d = ind_a2
					while lines[m-1][d] != '"':
						d-=1
					ind_a2 = d

					ind_b1 = lines[m].find('"',ind_b1,ind_b2)+1
					d = ind_b2
					while lines[m][d] != '"':
						d-=1
					ind_b2 = d

					str1 = amb.eliminate_all(lines[m-1][ind_a1:ind_a2],[',','.','!','?'])
					str2 = lines[m][ind_b1:ind_b2].replace('@depozzya_bot ','').replace('@depozzya_bot','')
					if len(str1)>=1:
						if (str1[len(str1)-1]) == ')':
							if amb.if_instanses_exists_str(str1,['(100)','(110)','(120)','(130)','(140)','(150)','(160)']) == 1:
								str1 = str1[0:len(str1)-6]
							else:
								str1 = str1[0:len(str1)-5]
					if len(str2)>=1:
						if (str2[len(str2)-1]) == ')':
							if amb.if_instanses_exists_str(str2,['(100)','(110)','(120)','(130)','(140)','(150)','(160)']) == 1:
								str2 = str2[0:len(str2)-6]
							else:
								str2 = str2[0:len(str2)-5]

					key = str1.lower().split(' ')

					# print(str1)
					# print(str2)
					# print(str(key)+'\n')
					
					if amb.eliminate_all(str2,[' ','4','?','1','`',"'",')','.']) != '':
						for k in range(len(key)):
							try:
								try:
									l = replies[keys.index(key[k])].index(str2)
								except ValueError:
									replies[keys.index(key[k])].append(str2)
							except ValueError:
								keys.append(key[k])
								# print(str(keys))
								replies.append([str2])
								# replies[keys.index(key[k])].append(str2)

def write_keys_taggen():
	f = open("conmes/tags.txt", "w", encoding = 'utf-8')
	line = ''
	for i in range(len(keys)):
		line = line + keys[i]+' : '
		for m in range(len(replies[i])):
			line = line + '"'+replies[i][m]+'",'
		line = line + '\n'
	f.write(line)
	f.close()

def check_tags(text):
	global lasttype
	global lastind
	lastind = [text]
	text = amb.eliminate_all(text,[',','.','!','?'])
	splt = text.split(' ')

	for i in range(len(splt)):
		ind = random.randint(0,len(splt)-1)

		try:					
			ind = keys.index(splt[ind].lower())
			rnt = random.randint(0,len(replies[ind])-1)

			lastind.append(replies[ind][rnt]) 
			lasttype = 'taggen'
			return replies[ind][rnt]
			break
		except ValueError:
			splt.remove(splt[ind])

	return fuck(0)

# print(check_tags("Кто сделал геометрию?"))

#
# [4]  Система темплейтов - parts
#

# Если цифровое значение
# Ищем рандомный темплейт
# Прокручиваем все значения в темплейте
# От цифры вылавливаем значение парта, генерим	
# рандомное число и соответственно слово
def fuck(arg):
	global lasttype
	global lastind
	ct = random.randint(0,len(templates)-1)					
	msg = ""
	commes = 0
	nextformat = 0
	htof = 0
	actual = []

	for i in range(len(templates[ct])):	
		if amb.isint(templates[ct][i]):
			#Если цифровое значение
			m = templates[ct][i]							
			cp = random.randint(0,len(parts[m])-1)															
			
			#Система комьюнити						
			if amb.isinstr(parts[m][cp],'_!#*c@mmunity') != -1:
				commes = 1
				submsg = parts[m][cp].replace('_!#*c@mmunity','')
			else: 
				submsg = parts[m][cp]
			
			#rod = pick(htof,submsg)
			submsg = formatword(nextformat,submsg,htof)
			actual.append(submsg)
			msg = msg+submsg+' '
			

			#Сбиваем формат
			nextformat = 0	
			htof = 0
		elif (amb.isinstr(templates[ct][i],'fmt%')!=-1):
			#Если стринг формата
			actual.append(templates[ct][i])	

			nextformat = int(templates[ct][i].replace('fmt%',''))

		elif (amb.isinstr(templates[ct][i],'pick%')!=-1):
			#Если стринг формата
			actual.append(templates[ct][i])	

			htof = pick(1,actual[int(templates[ct][i].replace('pick%',''))])

		elif (amb.isinstr(templates[ct][i],'l%')!=-1):
			#Если стринг формата
			actual.append(templates[ct][i])	

			msg = msg[0:len(msg)-int(templates[ct][i].replace('l%',''))]

		else:
			#Если стринг не содержит спец. символов, то выводим его без форматирования и цоклов
			actual.append(templates[ct][i])	

			msg = msg+templates[ct][i]		
			nextformat = 0
			htof = 0
	msg = msg[0:1].upper()+msg[1:len(msg)].lower()
	lastind.append(msg) 
	lasttype = 'parts'
	if arg == 'split':
		if (commes == 1):
			msg = [msg,'<i>Это сообщение было сгенерировано с помощью коммьюнити (/add_word). Если в нем что-то не так, напишите @depozzyx</i>']
		else:
			msg = [msg,'']
	else:
		if (commes == 1):
			msg + '\n\n<i>Это сообщение было сгенерировано с помощью коммьюнити (/add_word). Если в нем что-то не так, напишите @depozzyx</i>'		
	return msg

def tospeech(text):
	tts = gTTS(text, lang='ru')
	print(text)
	tts.save('sound.mp3')
	return 1

# def getspeech():
# 	# data, samplerate = sf.read('russian.ogg')
# 	# sf.write('russian.wav', data, samplerate)
# 	AUDIO_FILE = "russian.wav"
# 	r = sr.Recognizer()
# 	with sr.AudioFile(AUDIO_FILE) as source:
# 	    audio = r.record(source)
# 	try:
# 	    # for testing purposes, we're just using the default API key
# 	    # to use another API key, use `r.recognize_google(audio, key="GOOGLE_SPEECH_RECOGNITION_API_KEY")`
# 	    # instead of `r.recognize_google(audio)`
# 	    print("Google Speech Recognition thinks you said " + r.recognize_google(audio))
# 	except sr.UnknownValueError:
# 	    print("Google Speech Recognition could not understand audio")
# 	except sr.RequestError as e:
# 	    print("Could not request results from Google Speech Recognition service; {0}".format(e))

def addword(what,part):
	ind = parts_str.index(part)
	if (what+'_!#*c@mmunity' in parts[ind]) or (what in parts[ind]):
		return 0
		print('asasasasas')

	f = open("conmes/"+part+".txt", "a",encoding='utf-8')

	f.write('\n'+what+'_!#*c@mmunity')

	parts[ind].append(what+'_!#*c@mmunity')
	amb.log('[CMS] Adding word '+what+', as '+part, 'system')
	# print('[CMS] parts[i]: '+str(parts[i])+', parts_str[i]: '+str(parts_str[i]))
	f.close()
	return 1

def pick(how,what):
	if (how == 0):
		res = 0
	elif (how == 1):
		lchar = what[len(what)-1:len(what)]
		#print(lchar+' '+what)
		if lchar == 'а':
			res = 1
		elif lchar == 'о':
			res = 2
		else:
			res = 0
	# amb.debug(what+' '+str(res))
	return res

def formatword(how,what,rod):
	word = ''
	#amb.debug(str(rod))
	if (how == 0):
		word = what

	elif (how == 1):
		#word = what[0:len(what)-1]
		word = what.replace('ть','').replace('ти','').replace('ся','')
		if rod == 0:
			word = word+'лся'
		elif rod == 1:
			word = word+'лась'
		elif rod == 2:
			word = word+'лось'
		elif rod == 3:
			word = word+'лись'
		else:
			word = what+'<i>(fmt+rod err)</i>'
	elif (how == 2):
		word = what.replace('ть','').replace('ти','').replace('ся','')
		# amb.debug('ROD = '+str(rod))
		if rod == 0:
			word = word+'л'
		elif rod == 1:
			word = word+'ла'
		elif rod == 2:
			word = word+'ло'
		elif rod == 3:
			word = word+'ли'
		else:
			word = what+'<i>(fmt+rod err)</i>'

	elif (how == 3):
		word = what.replace('ый','').replace('ой','').replace('ий','')
		# amb.debug('ROD = '+str(rod))
		if rod == 0:
			word = what
		elif rod == 1:
			word = word+'ая'
		elif rod == 2:
			word = word+'ое'
		elif rod == 3:
			word = word+'ые'
		else:
			word = what+'<i>(fmt+rod err)</i>'

	else:
		word = what+'<i>(fmt err)</i>'

	return word


initialize()
initialize_taggen()
initialize_smatch()