import sys
from PyQt4 import QtCore, QtGui
from PyQt4.QtGui import *
from control import Ui_Control
from lineEdit import Ui_lineEdit
from distancia import Ui_distancia
from saida import Ui_Saida
from logo import Ui_Logo
from time import sleep
import serial
import glob

def scan():
    return glob.glob('/dev/ttyU*') +  glob.glob('/dev/ttyA*')

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
    Serial = serial.Serial(scan()[0])
    robos = []
    portas = []
    
    def __init__(self, parent=None):
        QtGui.QMainWindow.__init__(self, parent)
        self.setObjectName(_fromUtf8("Form"))
        self.setWindowTitle(QtGui.QApplication.translate("Form", "Ferramenta de Controle - Robo Livre", None, QtGui.QApplication.UnicodeUTF8))
        
        #Logo Robo Livre
        self.logo = Ui_Logo()
        self.logo.setupUi(self)
        
        #Menu de abas
        self.menuDeAbas = QtGui.QTabWidget(self)
        self.menuDeAbas.setGeometry(QtCore.QRect(10, 60, 680, 330))
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
        self.saidaAba1 = Ui_Saida()
        self.saidaAba1.setupUi(self.aba1)
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
        ##
        #
        #Botao Listar Comandos
        self.botaoListarComandos = QtGui.QPushButton(self.aba2)
        self.botaoListarComandos.setGeometry(QtCore.QRect(35, 30, 600, 27))
        self.botaoListarComandos.setText(QtGui.QApplication.translate("Form", "Listar os comandos", None, QtGui.QApplication.UnicodeUTF8))
        self.botaoListarComandos.setObjectName(_fromUtf8("Enviar"))
        #Evento de Listar Comandos
        self.botaoListarComandos.clicked.connect(self.listarComandos)               
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))
        #
        #Terminal de Saida
        self.saidaAba2 = Ui_Saida()
        self.saidaAba2.setupUi(self.aba2)
        #
        ##
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))
        
        self.botaoRobo0 = QtGui.QPushButton(self)
        self.botaoRobo0.setGeometry(QtCore.QRect(480, 7, 97, 27))
        self.botaoRobo0.clicked.connect(self.robo0)         
        self.botaoRobo0.setVisible(False)      
   

        self.botaoRobo1 = QtGui.QPushButton(self)
        self.botaoRobo1.setGeometry(QtCore.QRect(580, 7, 97, 27))
        self.botaoRobo1.clicked.connect(self.robo1)
        self.botaoRobo1.setVisible(False)
    

        self.botaoRobo2 = QtGui.QPushButton(self)
        self.botaoRobo2.setGeometry(QtCore.QRect(380, 47, 97, 27))
        self.botaoRobo2.clicked.connect(self.robo2)
        self.botaoRobo2.setVisible(False)
   
        self.botaoRobo3 = QtGui.QPushButton(self)
        self.botaoRobo3.setGeometry(QtCore.QRect(480, 47, 97, 27))
        self.botaoRobo3.clicked.connect(self.robo3)
        self.botaoRobo3.setVisible(False)
    

        self.botaoRobo4 = QtGui.QPushButton(self)
        self.botaoRobo4.setGeometry(QtCore.QRect(580, 47, 97, 27))
        self.botaoRobo4.clicked.connect(self.robo4)
        self.botaoRobo4.setVisible(False)
        
        
        self.botaoBusca = QtGui.QPushButton(self)
        self.botaoBusca.setGeometry(QtCore.QRect(380, 7, 47, 27))
        #self.paraFrente.setText(QtGui.QApplication.translate("Control", "Para Frente", None, QtGui.QApplication.UnicodeUTF8))
        self.iconRefresh = QtGui.QIcon("imagens/refresh/botao_refresh.png")
        self.botaoBusca.setIcon(self.iconRefresh)
        self.botaoBusca.setObjectName(_fromUtf8("Refresh"))
        self.botaoBusca.clicked.connect(self.busca_robos)
        
        
        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(2)
        QtCore.QMetaObject.connectSlotsByName(self)
        
        #Tamanho da janela principal MainWidget
        self.resize(700, 400)

    def metododoDoMenuDeAbas(self, Form):
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba1), QtGui.QApplication.translate("Form", "Movimentos Basicos", None, QtGui.QApplication.UnicodeUTF8))
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba2), QtGui.QApplication.translate("Form", "Lista de Comandos", None, QtGui.QApplication.UnicodeUTF8))


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

    def listarComandos(self):
        self.quantosComandos = "quantoscomandos"
        resposta = ''
        #Atribuir tamanho do protocolo
        MainWidget.tamanho = len(MainWidget.destinatario) + len(self.quantosComandos) + len(MainWidget.remetente) + 9
        #Atribuir mensagem, ainda sem o Checksum
        MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + self.quantosComandos + ' ' + MainWidget.remetente
        
        
        if ( (len(str(MainWidget.tamanho))) < 3):
            #Se o tamanho do protocolo nao tiver tres digitos, adicionar o numero zero ao inicio do campo tamanho
            MainWidget.mensagem = MainWidget.destinatario + '0' + str(MainWidget.tamanho) + self.quantosComandos + ' ' + MainWidget.remetente
        else:
            #Senao, o tamanho eh dado normal
            MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + self.quantosComandos + ' ' + MainWidget.remetente
        
        
        #Calculo de Checksum
        for i in range(len(MainWidget.mensagem)):
            MainWidget.checksum = MainWidget.checksum + ord(str(MainWidget.mensagem[i]))       
        if len(str(MainWidget.checksum)) < 5:
            for i in range(5 - len(str(MainWidget.checksum))):
                MainWidget.mensagem = MainWidget.mensagem + '0'        
                
        
        MainWidget.mensagem = MainWidget.mensagem + str(MainWidget.checksum)
        MainWidget.Serial.write(str(MainWidget.mensagem))
        print self.mensagem
        sleep(0.5)
        
        while (MainWidget.Serial.inWaiting() > 0):
            resposta = resposta + MainWidget.Serial.read()
        print resposta
        
        count = 0
        bool = False
        quantidadeDeComandos = ''
        
        for count in range (len(resposta)):
            if ((resposta[count] == ' ') and bool==False):
                quantidadeDeComandos = resposta[count + 1]
                if(MainWidget.mensagem[count + 2] != " "):
                    quantidadeDeComandos = quantidadeDeComandos + resposta[count + 2]
                bool = True
        
        qtdDeComandos = (int(quantidadeDeComandos))
        quantidadeDeComandos = (int(quantidadeDeComandos))
        
        
        exibeComando = "exibecomando"
        
        cont = 0
        while (quantidadeDeComandos > 0):
            self.zerarVariaveis()
            
            MainWidget.tamanho = len(MainWidget.destinatario) + len(exibeComando) + len(str(quantidadeDeComandos)) + len(MainWidget.remetente) + 10
            MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + exibeComando + ' ' + str(quantidadeDeComandos) + ' ' + MainWidget.remetente
            
            if ( (len(str(MainWidget.tamanho))) < 3):
                #Se o tamanho do protocolo nao tiver tres digitos, adicionar o numero zero ao inicio do campo tamanho
                MainWidget.mensagem = MainWidget.destinatario + '0' + str(MainWidget.tamanho) + exibeComando + ' ' + str(quantidadeDeComandos) + ' ' + MainWidget.remetente
            else:
                #Senao, o tamanho eh dado normal
                MainWidget.mensagem = MainWidget.destinatario + str(MainWidget.tamanho) + exibeComando + ' ' + str(quantidadeDeComandos) + ' ' + MainWidget.remetente
                
            for i in range(len(MainWidget.mensagem)):
                MainWidget.checksum = MainWidget.checksum + ord(str(MainWidget.mensagem[i]))       
            if len(str(MainWidget.checksum)) < 5:
                for i in range(5 - len(str(MainWidget.checksum))):
                    MainWidget.mensagem = MainWidget.mensagem + '0' 
            
            MainWidget.mensagem = MainWidget.mensagem + str(MainWidget.checksum)
            
            MainWidget.Serial.write(str(MainWidget.mensagem))    
            
            sleep(0.3)
            
            count = 0
            
            while (MainWidget.Serial.inWaiting() > 0):
                resposta = resposta + MainWidget.Serial.read()
            
            arrayResposta = []
            arrayResposta.append(resposta)
            print resposta    
            print MainWidget.mensagem
            resposta = ''
            cont = cont + 1
            quantidadeDeComandos = quantidadeDeComandos - 1
        
        for i in range(cont-1):
            self.saidaAba2.imprimirSaida("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + arrayResposta[i])
        
        self.comboBox = QtGui.QComboBox(self)
        self.comboBox.setGeometry(QtCore.QRect(30, 30, 85, 27))
        self.comboBox.setObjectName(_fromUtf8("comboBox"))
        #self.comboBox.addItems(lista2)
        
        for i in range(count):
            print i
        
        self.zerarVariaveis()
        
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
        self.saidaAba1.imprimirSaida("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + resposta)

        self.zerarVariaveis()
        
   
    def zerarVariaveis(self):
        MainWidget.mensagem = ''
        MainWidget.tamanho = 0
        MainWidget.remetente = 'PC'
        MainWidget.checksum = 0

    def robo0(self):
        self.lineEditAba1.nomeDoRobo.setText(str(MainWidget.robos[0]))
        MainWidget.destinatario = MainWidget.robos[0]
        MainWidget.Serial = serial.Serial(MainWidget.portas[0])
        MainWidget.Serial.open()
    
    def robo1(self):
        self.lineEditAba1.nomeDoRobo.setText(str(MainWidget.robos[1]))
        MainWidget.destinatario = MainWidget.robos[1]
        MainWidget.Serial = serial.Serial(MainWidget.portas[1])
        MainWidget.Serial.open()
    
    def robo2(self):
        self.lineEditAba1.nomeDoRobo.setText(str(MainWidget.robos[2]))
        MainWidget.destinatario = MainWidget.robos[2]
        MainWidget.Serial = serial.Serial(MainWidget.portas[2])
        MainWidget.Serial.open()
        
    def robo3(self):
        self.lineEditAba1.nomeDoRobo.setText(str(MainWidget.robos[3]))
        MainWidget.destinatario = MainWidget.robos[3]
        MainWidget.Serial = serial.Serial(MainWidget.portas[3])
        MainWidget.Serial.open()
    
    def robo4(self):
        self.lineEditAba1.nomeDoRobo.setText(str(MainWidget.robos[4]))
        MainWidget.destinatario = MainWidget.robos[4]
        MainWidget.Serial = serial.Serial(MainWidget.portas[4])
        MainWidget.Serial.open()
    
    
    def busca_robos(self):
        MainWidget.robos = []
        MainWidget.portas = []
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
                MainWidget.robos.append(nome)
                MainWidget.portas.append(robo_porta.portstr)
                         
            robo_porta.close()
            
        
           
        if (len(MainWidget.robos) > 0):
            self.botaoRobo0.setText(MainWidget.robos[0])
            self.botaoRobo0.setVisible(True)
        
        if (len(MainWidget.robos) > 1):
            self.botaoRobo1.setText(MainWidget.robos[1])
            self.botaoRobo1.setVisible(True)
            
        if (len(MainWidget.robos) > 2):
            self.botaoRobo2.setText(MainWidget.robos[2])
            self.botaoRobo2.setVisible(True)

        if (len(MainWidget.robos) > 3):
            self.botaoRobo3.setText(MainWidget.robos[3])
            self.botaoRobo3.setVisible(True)
        
        if (len(MainWidget.robos) > 4):
            self.botaoRobo4.setText(MainWidget.robos[4])
            self.botaoRobo4.setVisible(True)

        
if __name__ == "__main__":
    app = QApplication(sys.argv)
    
    ui = MainWidget()
    ui.show()
    
    
    sys.exit(app.exec_())