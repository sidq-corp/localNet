import time
import datetime
import codecs
import sys

def remove_non_ascii(text):
    return ''.join([i if ord(i) <= 1071 else ' ' for i in text])
def deEmojify(inputString):
    return inputString.encode('utf-8', 'ignore').decode('utf-8')

def eliminate_all(text,al):
    for i in al:
    	text = text.replace(i,'')
    return text


def if_instanses_exists_str(text,al):
    for i in al:
    	if text.find(i) != -1:
    		return 1
    return 0

# print(str(if_instanses_exists_str('Ты хуйло!',['ты','рундук','руйло'])))

# print(eliminate_all('                         ))                                ',[' ','4','?','1','`',"'",')','.']))

def debug(dtxt):
	print('[DEBUG] '+dtxt)

	d = open("content/debug.txt", "a")
	d.write('[DEBUG] '+dtxt+'\n')
	d.close()

def log(dtxt,chat, custom_time = 0):

	type = -1
	try:
		if (chat.find('xe')):
			pass
		logtype = 0
		if (dtxt == 'Initialization started...'):
			logtype = 3
	except AttributeError:
		try:
			if (chat + 1):
				pass
			logtype = 1
		except TypeError:
			logtype = 2
	if (dtxt[0:1] != "["):
		dtxt = ' '+dtxt
	print('[LOG]'+dtxt)

	if (custom_time == 0):
		now = str(datetime.datetime.now())
	else:
		now = str(datetime.datetime.utcfromtimestamp(custom_time + 3*60*60))+'.000000'

	if (logtype == 0):
		tryfile("content/"+chat+".log")
		l = open("content/"+chat+".log", "a", encoding='utf-8')
	elif (logtype == 1):
		l = open("content/unrecognised.log", "a", encoding='utf-8')
	elif (logtype == 2):
		#print(str(chat))
		# tryfile("content/"+str(chat.title)+'_'+str(chat.id)+".log")
		# l = open("content/"+str(chat.title)+'_'+str(chat.id)+".log", "a")
		tryfile("content/"+str(chat.id)+".log")
		l = open("content/"+str(chat.id)+".log", "a")
	elif (logtype == 3):
		l = open("content/system.log", "a")
		l.write('\n \n \n')
	else:
		l = open("content/unrecognised.log", "a")
		dtxt = '[ERR]'+dtxt

	try:
		l.write('['+now+'][LOG]'+dtxt+'\n')
	except UnicodeEncodeError:
		ctxt = eliminate_fucking_emoji(str(sys.exc_info()[1]), '['+now+'][LOG]'+dtxt+'\n')
		l.write(ctxt[0:33]+'[UNICODEERR]'+ctxt[33:len(ctxt)])
	l.close()

	# l = open("content/log.txt", "a")
	# l.write('[LOG] '+dtxt+'\n')
	# l.close()
def eliminate_fucking_emoji(err,text):
	l = open("elimination.txt", "a")
	done = 0

	while done != 1 :
		ind = err.find('-')
		if ind != -1:
			ind2 = err.find(':',ind+1)
			ind2 = int(err[ind+1:ind2])

			i = ind-1
			while err[i] != ' ':
				i-= 1
			ind1 = int(err[i+1:ind])

			text = text[0:ind1]+text[ind2+1:len(text)]
		else:
			ind2 = err.find(':')
			i = ind2-1
			while err[i] != ' ':
				i-= 1
			ind = int(err[i+1:ind2])
			text = text[0:ind]+text[ind+1:len(text)]

		try:
			l.write(text)
			done = 1
		except UnicodeEncodeError:
			err = str(sys.exc_info()[1])
	
	l.close()
	return text

def tryfile(fle):
	try:
		# print(str(fle))
		f = open(fle)
		return 1
	except IOError:
		f = open(fle,"w+")
		return 0

def isint(var):
	try:
		int(var)
		return 1
	except ValueError:
		return 0
def isinstr(var,what):
	try:
		m = var.find(what)
		return(m)
	except:
		return -1

def checktime(frtime):
	tim = int(time.time())
	if (tim - frtime < 10):
		return 1
	else:
		return 0

def check_run_time(frtime):
	tim = int(time.time())
	if (tim - frtime < 10):
		return 1
	else:
		return 0

# print(deEmojify('🥰🥰'))
