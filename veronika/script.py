import time
import conmes 

while True:
	f = open("input.txt", "r", encoding = 'utf-8')
	text = f.read()
	f.close()
	if text != '':
		out = conmes.find_smatch(text)
		f = open("output.txt", "w", encoding = 'utf-8')
		f.write(out)
		f.close()
		with open('chat.txt', 'r', encoding = 'utf-8') as file:
			a=file.readlines()
			a.insert(0, "Вы: " + text + '<br><br>\n')
			a.insert(0, "Бот: " + out + '<br>\n')
			
		with open('chat.txt', 'w', encoding = 'utf-8') as file:
			file.writelines(a)

		f = open("input.txt", "w", encoding = 'utf-8')
		f.write('')
		f.close()

	time.sleep(1)