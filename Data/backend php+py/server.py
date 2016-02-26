import socket
import sys
import RPi.GPIO as GPIO, time, os
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)

GPIO.setmode(GPIO.BCM)


s = socket.socket() 
s.bind(("192.168.137.3",2000)) 
lightPin=18
statusPin=17
s.listen(4) 
status=-1
def readLight(pin):
        GPIO.setup(pin, GPIO.OUT)
        GPIO.output(pin, GPIO.LOW)
        time.sleep(0.1)
        reading=0
        GPIO.setup(pin, GPIO.IN)
        while (GPIO.input(pin) == GPIO.HIGH):
                pass
        while (GPIO.input(pin) == GPIO.LOW) and (reading<2000) :
                reading += 1
        return reading

while 1==1:
		c, c_addr = s.accept()
		print(c_addr, "has connected")
		recvieved_data = c.recv(1024)
		print(recvieved_data)
		text=recvieved_data.split(':')
		statusPin=int(text[1])
		print isinstance( text[1], int )
		status=-1
		if text[0] == 'uit':
			status=0
		else:
			status=int(text[0])
		print str(status)
		GPIO.setup(statusPin, GPIO.OUT)
		if (status == 1) or (status==0):
			print "status 1 or 0"
			GPIO.output(statusPin, status)
		else:
			print "status not 1 or 0"
			status=GPIO.input(statusPin)
		if status==1:
			print "status=1"
			waarde=readLight(lightPin)
		if status==0:
			print "status=0"
			waarde=-1
		c.sendall(str(waarde)+":"+str(status))
		c.close()


