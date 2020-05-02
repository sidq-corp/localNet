import time
import conmes 

while True:
	f = open("input.txt", "r", encoding = 'utf-8')
	text = f.read()
	
	f.close()
	if text != '':
		name = text.split("@%@")[0]
		text = text.split("@%@")[1]
		out = conmes.find_smatch(text)
		f = open("output.txt", "w", encoding = 'utf-8')
		f.write(out)
		f.close()
		with open('chat.txt', 'r', encoding = 'utf-8') as file:
			a=file.readlines()
			a.insert(0, "Бот: " + out + '<br><br>\n')
			a.insert(0, name + ": " + text + '<br>\n')
		with open('chat.txt', 'w', encoding = 'utf-8') as file:
			file.writelines(a)

		f = open("input.txt", "w", encoding = 'utf-8')
		f.write('')
		f.close()

	time.sleep(1)