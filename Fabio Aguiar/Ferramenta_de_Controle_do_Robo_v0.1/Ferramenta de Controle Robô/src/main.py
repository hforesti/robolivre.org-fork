import sys
from PyQt4 import QtCore, QtGui
from PyQt4.QtGui import *
from control import Ui_Control
from sensor import Ui_Sensor
from lineEdit import Ui_lineEdit
from distancia import Ui_distancia
from saida import Ui_Saida
from time import sleep
import serial
Serial = serial.Serial('/dev/ttyACM0', 9600)
Serial.open()


try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s


class MainWidget(QtGui.QWidget):
    mensagem = ''
    destinatario = 'MNERIM'
    tamanho = 0
    comando = ''
    distancia = ''
    remetente = 'PC'
    checksum = 0
    
    def __init__(self, parent=None):
        QtGui.QMainWindow.__init__(self, parent)
        self.setObjectName(_fromUtf8("Form"))
        self.setWindowTitle(QtGui.QApplication.translate("Form", "Form", None, QtGui.QApplication.UnicodeUTF8))
        
        #Instancias
        #self.sensor = Ui_Sensor()
        
        #Chamada das instancias
        #self.sensor.setupUi(self)





        #Menu de abas
        self.menuDeAbas = QtGui.QTabWidget(self)
        self.menuDeAbas.setGeometry(QtCore.QRect(10, 30, 690, 350))
        self.menuDeAbas.setObjectName(_fromUtf8("menus"))
        
        
        #Botao Enviar
 #       self.botaoEnviar = QtGui.QPushButton(self)
 #       self.botaoEnviar.setGeometry(QtCore.QRect(500, 230, 97, 27))
 #       self.botaoEnviar.setText(QtGui.QApplication.translate("Form", "Enviar", None, QtGui.QApplication.UnicodeUTF8))
 #       self.botaoEnviar.setObjectName(_fromUtf8("Enviar"))
        
        #Evento do Enviar
 #       self.botaoEnviar.clicked.connect(self.enviar)
        
        #Eventos do control

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
        self.lineEdit = Ui_lineEdit()
        self.lineEdit.setupUi(self)
        #Distancia
        self.distancia = Ui_distancia()
        self.distancia.setupUi(self)
        #Terminal de Saida
        self.saida = Ui_Saida()
        self.saida.setupUi(self)
        #       
        self.menuDeAbas.addTab(self.aba1, _fromUtf8(""))
        ##
        
        self.aba2 = QtGui.QWidget()
        self.aba2.setObjectName(_fromUtf8("aba_2"))
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))
        
        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(2)
        QtCore.QMetaObject.connectSlotsByName(self)
        
        #Tamanho da janela principal MainWidget
        self.resize(715, 400)

    def metododoDoMenuDeAbas(self, Form):
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba1), QtGui.QApplication.translate("Form", "Tab 1", None, QtGui.QApplication.UnicodeUTF8))
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba2), QtGui.QApplication.translate("Form", "Tab 2", None, QtGui.QApplication.UnicodeUTF8))


    def parafrente(self):
        self.lineEdit.comando.setText("parafrente")
        MainWidget.comando = 'parafrente'
        
    def paraTras(self):
        self.lineEdit.comando.setText("paratras")
        MainWidget.comando = 'paratras'
    
    def giraDireita(self):
        self.lineEdit.comando.setText("giradireita")
        MainWidget.comando = 'giradireita'
        
    def giraEsquerda(self):
        self.lineEdit.comando.setText("giraesquerda")
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
    
        self.lineEdit.tamanho.setText(str(MainWidget.tamanho))
        self.lineEdit.distancia.setText(str(MainWidget.distancia))
        self.lineEdit.checksum.setText(str(MainWidget.checksum))
        
        
        MainWidget.mensagem = MainWidget.mensagem + str(MainWidget.checksum)
        print MainWidget.mensagem
        Serial.write(str(MainWidget.mensagem))

        sleep(1.7)
        resposta = ''
        while (Serial.inWaiting() > 0):
            resposta = resposta + Serial.read()
        print resposta
        self.saida.vai("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + resposta)

        self.zerarVariaveis()
        
        #MainWidget.distancia = self.distancia.distanciaLineEdit.text()
        #MainWidget.protocolo = MainWidget.nomeDoRobo + MainWidget.tamanho + MainWidget.comando + MainWidget.distancia + MainWidget.remetente + MainWidget.checksum
        #MainWidget.tamanho = len(MainWidget.protocolo)
        #MainWidget.protocolo = MainWidget.nomeDoRobo + MainWidget.tamanho + MainWidget.comando + MainWidget.distancia + MainWidget.remetente + MainWidget.checksum
        #Serial.write(MainWidget.protocolo)
        #sleep(2)
        #printar = ''
        #while Serial.inWaiting() > 0:
        #    printar = printar + Serial.read()
        #print printar
        
    def zerarVariaveis(self):
        MainWidget.mensagem = ''
        MainWidget.destinatario = 'MNERIM'
        MainWidget.tamanho = 0
        #MainWidget.comando = ''
        #MainWidget.distancia = ''
        MainWidget.remetente = 'PC'
        MainWidget.checksum = 0
        
        
if __name__ == "__main__":
    app = QApplication(sys.argv)
    
    ui = MainWidget()
    ui.show()
    
    
    sys.exit(app.exec_())