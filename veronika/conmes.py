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

smatch_keystrings = []
smatch_matches = []
smatch_rates = []
lastind = -1
lasttype = -1
lastpair = -1

def initialize_smatch():
	f = open("conmes/smatch.txt", "r", encoding = 'utf-8')
	lines = f.readlines()
	amb.log('[CMS] Initializing smatch ['+str(len(lines))+']','system')
	f.close()

	for i in range(len(lines)):
		ind = lines[i].find('" : "')
		if (ind != -1):
			if (i == len(lines)-1):
				lines[i] += '\n'

			smatch_keystrings.append(lines[i][1:ind])
			smatch_matches.append(lines[i][ind+5:len(lines[i])-7])
			smatch_rates.append(int(lines[i][len(lines[i])-5:len(lines[i])]))




# P.S. Функции выше запускаются в самом низу

# 
# [2] Система нечеткого сравнения - smatch
# 
def find_smatch(text, alter = 0):
	global lastind
	global lasttype
	global lastpair

	ctext = amb.eliminate_all(text.lower(),[',','.','!','?'])
	maxsmatch = 0
	maxmatches = []
	maxindexes = []
	blacklist = []
	print(str(lastind))
	for i in range(len(smatch_keystrings)):
		if ((alter == 1) and (smatch_matches[i] != lastpair[1])) or (alter == 0):
			cursmatch_temp = fuzz.ratio(ctext, amb.eliminate_all(smatch_keystrings[i].lower(),[',','.','!','?']))
			if (smatch_rates[i] == -100) and (cursmatch_temp == 100):
				blacklist.append(smatch_matches[i])
				cursmatch = 0

			else:
				cursmatch = cursmatch_temp

			if cursmatch >= maxsmatch:
				if cursmatch != maxsmatch:
					maxmatches = [smatch_matches[i]]
					maxindexes = [i]
					maxsmatch = cursmatch
				elif (cursmatch == maxsmatch):
					maxmatches.append(smatch_matches[i])
					maxindexes.append(i)
			
	print('before blacklist: '+str(maxmatches)+ ' - '+str(maxsmatch)+'; blacklist: '+str(blacklist))
	if (maxsmatch > 50):
		for i in range(len(maxmatches)):
			try:
				for m in range(len(blacklist)):
					# print(maxmatches[i] + ' '+ blacklist[m])
					if maxmatches[i] == blacklist[m]:
						# print('DEL')
						maxmatches.pop(i)
						break

			except IndexError:
				break
		print('after blacklist: '+str(maxmatches)+ ' - '+str(maxsmatch))
		if (len(maxmatches) == 0):
			lastind = -1
			lasttype = -1
			lastpair = [text]
			return check_tags(text)
		else:
			ind = random.randint(0,len(maxmatches)-1)
			lastind = maxindexes[ind]
			lasttype = 'smatch'
			lastpair = [text, maxmatches[ind]]
			return maxmatches[ind]
	else:
		lastind = -1
		lasttype = -1
		lastpair = [text]
		return check_tags(text)

# 
# [3]  Система тегов - taggen
# 


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

			lastpair.append(replies[ind][rnt]) 
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
	lastpair.append(msg) 
	lasttype = 'parts'
	if arg == 'split':
		if (commes == 1):
			msg = [msg,'']
			# msg = [msg,'<i>Это сообщение было сгенерировано с помощью коммьюнити (/add_word). Если в нем что-то не так, напишите @depozzyx</i>']
		else:
			msg = [msg,'']
	else:
		if (commes == 1):
			pass
			# msg + '\n\n<i>Это сообщение было сгенерировано с помощью коммьюнити (/add_word). Если в нем что-то не так, напишите @depozzyx</i>'	
			# msg + ''		
	return msg

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