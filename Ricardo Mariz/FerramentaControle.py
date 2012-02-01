# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'QtFerramenta.ui'
#
# Created: Tue Jan 24 10:04:29 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui
import serial
from time import sleep
Serial = serial.Serial('/dev/ttyACM0', 9600)
Serial.open()

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Form(object):
    def setupUi(self, Form):
        Form.setObjectName(_fromUtf8("Ferramenta de Controle PSIU"))
        Form.resize(564, 320)
        Form.setWindowTitle(QtGui.QApplication.translate("Form", "Ferramenta de Controle PSIU", None, QtGui.QApplication.UnicodeUTF8))
        
	self.parafrente = QtGui.QPushButton(Form)
        self.parafrente.setGeometry(QtCore.QRect(10, 210, 97, 27))
        self.parafrente.setText(QtGui.QApplication.translate("Form", "parafrente", None, QtGui.QApplication.UnicodeUTF8))
        self.parafrente.setObjectName(_fromUtf8("parafrente"))
	self.parafrente.clicked.connect(self.func_parafrente)

        self.paratras = QtGui.QPushButton(Form)
        self.paratras.setGeometry(QtCore.QRect(140, 210, 97, 27))
        self.paratras.setText(QtGui.QApplication.translate("Form", "paratras", None, QtGui.QApplication.UnicodeUTF8))
        self.paratras.setObjectName(_fromUtf8("paratras"))
	self.paratras.clicked.connect(self.func_paratras)

        self.giradireita = QtGui.QPushButton(Form)
        self.giradireita.setGeometry(QtCore.QRect(140, 250, 97, 27))
        self.giradireita.setText(QtGui.QApplication.translate("Form", "giradireita", None, QtGui.QApplication.UnicodeUTF8))
        self.giradireita.setObjectName(_fromUtf8("giradireita"))
	self.giradireita.clicked.connect(self.func_giradireita)

        self.giraesquerda = QtGui.QPushButton(Form)
        self.giraesquerda.setGeometry(QtCore.QRect(10, 250, 97, 27))
        self.giraesquerda.setText(QtGui.QApplication.translate("Form", "giraesquerda", None, QtGui.QApplication.UnicodeUTF8))
        self.giraesquerda.setObjectName(_fromUtf8("giraesquerda"))
	self.giraesquerda.clicked.connect(self.func_giraesquerda)

        self.comandos = QtGui.QLabel(Form)
        self.comandos.setGeometry(QtCore.QRect(60, 160, 121, 31))
        self.comandos.setStyleSheet(_fromUtf8(""))
        self.comandos.setText(QtGui.QApplication.translate("Form", "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n"
"<html><head><meta name=\"qrichtext\" content=\"1\" /><style type=\"text/css\">\n"
"p, li { white-space: pre-wrap; }\n"
"</style></head><body style=\" font-family:\'Ubuntu\'; font-size:11pt; font-weight:400; font-style:normal;\">\n"
"<p style=\" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;\"><span style=\" font-size:14pt; font-weight:600; color:#aa0000;\">COMANDOS</span></p></body></html>", None, QtGui.QApplication.UnicodeUTF8))
        self.comandos.setObjectName(_fromUtf8("comandos"))
        self.lcdNumber = QtGui.QLCDNumber(Form)
        self.lcdNumber.setGeometry(QtCore.QRect(390, 200, 131, 81))
        self.lcdNumber.setObjectName(_fromUtf8("lcdNumber"))	
	#self.recebeSinal()

        self.label = QtGui.QLabel(Form)
        self.label.setGeometry(QtCore.QRect(400, 170, 111, 21))
        self.label.setText(QtGui.QApplication.translate("Form", "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n"
"<html><head><meta name=\"qrichtext\" content=\"1\" /><style type=\"text/css\">\n"
"p, li { white-space: pre-wrap; }\n"
"</style></head><body style=\" font-family:\'Ubuntu\'; font-size:11pt; font-weight:400; font-style:normal;\">\n"
"<p style=\" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;\"><span style=\" font-size:14pt; font-weight:600; color:#00aa00;\">DISTÂNCIA</span></p></body></html>", None, QtGui.QApplication.UnicodeUTF8))
        self.label.setObjectName(_fromUtf8("label"))
        self.label_2 = QtGui.QLabel(Form)
        self.label_2.setGeometry(QtCore.QRect(520, 240, 67, 21))
        self.label_2.setText(QtGui.QApplication.translate("Form", "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n"
"<html><head><meta name=\"qrichtext\" content=\"1\" /><style type=\"text/css\">\n"
"p, li { white-space: pre-wrap; }\n"
"</style></head><body style=\" font-family:\'Ubuntu\'; font-size:11pt; font-weight:400; font-style:normal;\">\n"
"<p style=\" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;\"><span style=\" font-size:14pt; font-weight:600;\">CM</span></p></body></html>", None, QtGui.QApplication.UnicodeUTF8))
        self.label_2.setObjectName(_fromUtf8("label_2"))
        self.label_3 = QtGui.QLabel(Form)
        self.label_3.setGeometry(QtCore.QRect(210, 10, 151, 71))
        self.label_3.setText(QtGui.QApplication.translate("Form", "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n"
"<html><head><meta name=\"qrichtext\" content=\"1\" /><style type=\"text/css\">\n"
"p, li { white-space: pre-wrap; }\n"
"</style></head><body style=\" font-family:\'Ubuntu\'; font-size:11pt; font-weight:400; font-style:normal;\">\n"
"<p style=\" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;\"><span style=\" font-size:22pt; font-weight:600; color:#000000;\">MNERIM</span></p></body></html>", None, QtGui.QApplication.UnicodeUTF8))
        self.label_3.setObjectName(_fromUtf8("label_3"))

        self.retranslateUi(Form)
        QtCore.QMetaObject.connectSlotsByName(Form)

    def retranslateUi(self, Form):        
	pass
	
    
    def func_parafrente(self):
	string = 'MNERIM029parafrente 100 '
	checksum = 0	
	for i in range(len(string)):
		checksum = checksum + ord(string[i])		
	if len(str(checksum)) < 5:
		for i in range(5 - len(str(checksum))):
			string = string + '0'
		
	string = string + str(checksum)		
	Serial.write(string)
	sleep(1.5)
	self.recebeSinal()


    def func_paratras(self):
	string = 'MNERIM027paratras 100 '
	checksum = 0		
	for i in range(len(string)):
		checksum = checksum + ord(string[i])		
	if len(str(checksum)) < 5:
		for i in range(5 - len(str(checksum))):
			string = string + '0'
			
	string = string + str(checksum)		
	Serial.write(string)
	sleep(1.5)
	self.recebeSinal()


    def func_giradireita(self):
	string = 'MNERIM030giradireita 100 '
	checksum = 0		
	for i in range(len(string)):
		checksum = checksum + ord(string[i])		
	if len(str(checksum)) < 5:
		for i in range(5 - len(str(checksum))):
			string = string + '0'
			
	string = string + str(checksum)		
	Serial.write(string)
	sleep(1.5)
	self.recebeSinal()


    def func_giraesquerda(self):
	string = 'MNERIM031giraesquerda 100 '
	checksum = 0		
	for i in range(len(string)):
		checksum = checksum + ord(string[i])		
	if len(str(checksum)) < 5:
		for i in range(5 - len(str(checksum))):
			string = string + '0'
			
	string = string + str(checksum)		
	Serial.write(string)
	sleep(1.5)
	self.recebeSinal()

    
    def recebeSinal(self):	
	if (Serial.inWaiting() > 0):		
		distancia = ''	
		while(Serial.inWaiting() > 0):
			distancia = distancia + str(Serial.read())
			print distancia	
	  	
		self.lcdNumber.display(int(distancia))
    
    

if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Form = QtGui.QWidget()
    ui = Ui_Form()
    ui.setupUi(Form)   	
    Form.show()	 		
    sys.exit(app.exec_())
	

