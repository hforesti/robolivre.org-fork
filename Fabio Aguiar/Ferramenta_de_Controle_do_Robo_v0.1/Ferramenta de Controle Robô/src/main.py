import sys
from PyQt4 import QtCore, QtGui
from PyQt4.QtGui import *
from control import Ui_Control
from sensor import Ui_Sensor
from lineEdit import Ui_lineEdit
from distancia import Ui_distancia
from saida import Ui_Saida
from logo import Ui_Logo
from time import sleep
import serial
import glob


def scan():
    return glob.glob('/dev/ttyU*') +  glob.glob('/dev/ttyA*')


def busca_robos():
    robos = []
    portas = []
    for numero in range(len(scan())):
        robo_porta = serial.Serial(scan()[numero])
        robo_porta.open()
        pergunta = "??024qualseunome PC01654"
        robo_porta.write(str(pergunta))
        sleep(0.5)
        resposta = ''
        while (robo_porta.inWaiting() > 0):
            resposta = resposta + robo_porta.read() 

        if (resposta.find("qualseunome") > 0):
            nome = ""
            aux = resposta.find(" ") + 1 
            while(aux < len(resposta) -7):  
                nome += str(resposta[aux])
                aux += 1
            robos.append(nome)
            portas.append(robo_porta.portstr)
                     
        robo_porta.close()
        
           
  
    return robos, portas  



robos, portas = busca_robos()

print robos, portas


try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s


class MainWidget(QtGui.QWidget):
    mensagem = ''
    destinatario = ''
    tamanho = 0
    comando = ''
    distancia = ''
    remetente = 'PC'
    checksum = 0
    Serial = serial.Serial(portas[0])
    
    def __init__(self, parent=None):
        QtGui.QMainWindow.__init__(self, parent)
        self.setObjectName(_fromUtf8("Form"))
        self.setWindowTitle(QtGui.QApplication.translate("Form", "Form", None, QtGui.QApplication.UnicodeUTF8))
        
        #Logo Robo Livre
        self.logo = Ui_Logo()
        self.logo.setupUi(self)
        
        #Menu de abas
        self.menuDeAbas = QtGui.QTabWidget(self)
        self.menuDeAbas.setGeometry(QtCore.QRect(10, 30, 680, 330))
        self.menuDeAbas.setObjectName(_fromUtf8("menus"))

        ##
        self.aba1 = QtGui.QWidget()
        self.aba1.setObjectName(_fromUtf8("aba_1"))
        #Controle
        self.control = Ui_Control()
        self.control.setupUi(self.aba1)
        self.control.paraFrente.clicked.connect(self.parafrente)
        self.control.paraTras.clicked.connect(self.paraTras)
        self.control.giraDireita.clicked.connect(self.giraDireita)
        self.control.giraEsquerda.clicked.connect(self.giraEsquerda)
        #Line edit       
        self.lineEditAba1 = Ui_lineEdit()
        self.lineEditAba1.setupUi(self.aba1)
        #Distancia
        self.distancia = Ui_distancia()
        self.distancia.setupUi(self.aba1)
        #Terminal de Saida
        self.saida = Ui_Saida()
        self.saida.setupUi(self.aba1)
        #
        #Botao Enviar
        self.botaoEnviar = QtGui.QPushButton(self.aba1)
        self.botaoEnviar.setGeometry(QtCore.QRect(500, 150, 97, 27))
        self.botaoEnviar.setText(QtGui.QApplication.translate("Form", "Enviar", None, QtGui.QApplication.UnicodeUTF8))
        self.botaoEnviar.setObjectName(_fromUtf8("Enviar"))
        #Evento do Enviar
        self.botaoEnviar.clicked.connect(self.enviar)               
        self.menuDeAbas.addTab(self.aba1, _fromUtf8(""))
        ##
        
        self.aba2 = QtGui.QWidget()
        self.aba2.setObjectName(_fromUtf8("aba_2"))
        #Line edit
        self.lineEditAba2 = Ui_lineEdit()
        self.lineEditAba2.setupUi2(self.aba2)
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))
        
    
        if (len(robos) > 0):
            self.botaoRobo0 = QtGui.QPushButton(self)
            self.botaoRobo0.setGeometry(QtCore.QRect(200, 7, 97, 27))
            self.botaoRobo0.setText(QtGui.QApplication.translate("Form", robos[0], None, QtGui.QApplication.UnicodeUTF8))
            self.botaoRobo0.setObjectName(_fromUtf8(robos[0]))
            self.botaoRobo0.clicked.connect(self.robo0)               
       
        if (len(robos) > 1):
            self.botaoRobo1 = QtGui.QPushButton(self)
            self.botaoRobo1.setGeometry(QtCore.QRect(300, 7, 97, 27))
            self.botaoRobo1.setText(QtGui.QApplication.translate("Form", robos[1], None, QtGui.QApplication.UnicodeUTF8))
            self.botaoRobo1.setObjectName(_fromUtf8(robos[1]))
            self.botaoRobo1.clicked.connect(self.robo1)
        
        if (len(robos) > 2):
            self.botaoRobo2 = QtGui.QPushButton(self)
            self.botaoRobo2.setGeometry(QtCore.QRect(400, 7, 97, 27))
            self.botaoRobo2.setText(QtGui.QApplication.translate("Form", robos[2], None, QtGui.QApplication.UnicodeUTF8))
            self.botaoRobo2.setObjectName(_fromUtf8(robos[2]))
            self.botaoRobo2.clicked.connect(self.robo2)
        
        if (len(robos) > 3):
            self.botaoRobo3 = QtGui.QPushButton(self)
            self.botaoRobo3.setGeometry(QtCore.QRect(500, 7, 97, 27))
            self.botaoRobo3.setText(QtGui.QApplication.translate("Form", robos[3], None, QtGui.QApplication.UnicodeUTF8))
            self.botaoRobo3.setObjectName(_fromUtf8(robos[3]))
            self.botaoRobo3.clicked.connect(self.robo3)
        
        if (len(robos) > 4):
            self.botaoRobo4 = QtGui.QPushButton(self)
            self.botaoRobo4.setGeometry(QtCore.QRect(600, 7, 97, 27))
            self.botaoRobo4.setText(QtGui.QApplication.translate("Form", robos[4], None, QtGui.QApplication.UnicodeUTF8))
            self.botaoRobo4.setObjectName(_fromUtf8(robos[4]))
            self.botaoRobo4.clicked.connect(self.robo4)
        
        
        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(2)
        QtCore.QMetaObject.connectSlotsByName(self)
        
        #Tamanho da janela principal MainWidget
        self.resize(700, 400)
        

    def metododoDoMenuDeAbas(self, Form):
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba1), QtGui.QApplication.translate("Form", "Tab 1", None, QtGui.QApplication.UnicodeUTF8))
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba2), QtGui.QApplication.translate("Form", "Tab 2", None, QtGui.QApplication.UnicodeUTF8))


    def parafrente(self):
        self.lineEditAba1.comando.setText("parafrente")
        MainWidget.comando = 'parafrente'
        
    def paraTras(self):
        self.lineEditAba1.comando.setText("paratras")
        MainWidget.comando = 'paratras'
    
    def giraDireita(self):
        self.lineEditAba1.comando.setText("giradireita")
        MainWidget.comando = 'giradireita'
        
    def giraEsquerda(self):
        self.lineEditAba1.comando.setText("giraesquerda")
        MainWidget.comando = 'giraesquerda'
        
    def enviar(self):
        MainWidget.distancia = self.distancia.distanciaLineEdit.text()
        MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + MainWidget.comando + ' ' + MainWidget.distancia + ' ' + MainWidget.remetente
        MainWidget.tamanho = 10 + len(MainWidget.destinatario) +  len(MainWidget.comando)  + len(MainWidget.distancia) + len(MainWidget.remetente)
        
        
        if ( (len(str(MainWidget.tamanho))) < 3):
            MainWidget.mensagem = MainWidget.destinatario + '0' + str(MainWidget.tamanho) + MainWidget.comando + ' ' + MainWidget.distancia + ' ' + MainWidget.remetente
        else:
            MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + MainWidget.comando + ' ' + MainWidget.distancia + ' ' + MainWidget.remetente        
        
        
        for i in range(len(MainWidget.mensagem)):
            MainWidget.checksum = MainWidget.checksum + ord(str(MainWidget.mensagem[i]))        
        if len(str(MainWidget.checksum)) < 5:
            for i in range(5 - len(str(MainWidget.checksum))):
                MainWidget.mensagem = MainWidget.mensagem + '0'
    
        self.lineEditAba1.tamanho.setText(str(MainWidget.tamanho))
        self.lineEditAba1.distancia.setText(str(MainWidget.distancia))
        self.lineEditAba1.checksum.setText(str(MainWidget.checksum))
        
        
        MainWidget.mensagem = MainWidget.mensagem + str(MainWidget.checksum)
        print MainWidget.mensagem
        MainWidget.Serial.write(str(MainWidget.mensagem))

        delay = (float(MainWidget.distancia)/100)
	sleep(delay + 1)
        resposta = ''
        while (MainWidget.Serial.inWaiting() > 0):
            resposta = resposta + MainWidget.Serial.read()
        print resposta
        self.saida.vai("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + resposta)

        self.zerarVariaveis()
        
   
    def zerarVariaveis(self):
        MainWidget.mensagem = ''
        MainWidget.tamanho = 0
        MainWidget.remetente = 'PC'
        MainWidget.checksum = 0
    
    
    
    def robo0(self):
        self.lineEditAba1.nomeDoRobo.setText(str(robos[0]))
        MainWidget.destinatario = robos[0]
        MainWidget.Serial = serial.Serial(portas[0])
        MainWidget.Serial.open()
    
    def robo1(self):
        self.lineEditAba1.nomeDoRobo.setText(str(robos[1]))
        MainWidget.destinatario = robos[1]
        MainWidget.Serial = serial.Serial(portas[1])
        MainWidget.Serial.open()
    
    def robo2(self):
        self.lineEditAba1.nomeDoRobo.setText(str(robos[2]))
        MainWidget.destinatario = robos[2]
        MainWidget.Serial = serial.Serial(portas[2])
        MainWidget.Serial.open()
        
    def robo3(self):
        self.lineEditAba1.nomeDoRobo.setText(str(robos[3]))
        MainWidget.destinatario = robos[3]
        MainWidget.Serial = serial.Serial(portas[3])
        MainWidget.Serial.open()
    
    def robo4(self):
        self.lineEditAba1.nomeDoRobo.setText(str(robos[4]))
        MainWidget.destinatario = robos[4]
        MainWidget.Serial = serial.Serial(portas[4])
        MainWidget.Serial.open()
        
        
    

        


if __name__ == "__main__":
    app = QApplication(sys.argv)
    
    ui = MainWidget()
    ui.show()
    
    
    sys.exit(app.exec_())
