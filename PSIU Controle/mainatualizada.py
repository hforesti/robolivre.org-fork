import sys
from PyQt4 import QtCore, QtGui
from PyQt4.QtGui import *
from control import Ui_Control
from lineEdit import Ui_lineEdit
from distancia import Ui_distancia
from saida import Ui_Saida
from logo import Ui_Logo
from funcoes import Funcoes
from time import sleep
import serial
import glob
#from wadllib.application import Parameter


def scan():
    return glob.glob('/dev/ttyU*') +  glob.glob('/dev/ttyA*')


try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s


class MainWidget(QtGui.QWidget):
    mensagem = ''
    destinatario = ''
    tamanho = ''
    comando = ''
    distancia = ''
    remetente = 'PC'
    checksum = ''
    Serial = ''
    robos = []
    portas = []
    instanciaFuncoes = Funcoes()
    listaComandos = []
    listaParametrosInteiros = []
    listaParametrosFloat = []
    listaParametrosChar = []
    arrayInputsParametrosInt = []
    arrayInputsParametrosFloat = []
    arrayInputsParametrosChar = []
    arrayLabelsTiposParametrosInt = []
    arrayLabelsTiposParametrosFloat = []
    arrayLabelsTiposParametrosChar = []
    contInt = 0
    contFloat = 0
    contChar = 0

    
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
        #Lista de Comandos
        self.boxMenu = QtGui.QComboBox(self.aba2)
        self.boxMenu.setGeometry(QtCore.QRect(35, 80, 120, 27))
        self.boxMenu.setObjectName(_fromUtf8("boxMenu"))
        #
        ##
        self.bigLineEdit = QtGui.QLineEdit(self.aba2)
        self.bigLineEdit.setGeometry(QtCore.QRect(160, 80, 475, 27))
        self.bigLineEdit.setText(QtGui.QApplication.translate("Form", "", None, QtGui.QApplication.UnicodeUTF8))
        self.bigLineEdit.setObjectName(_fromUtf8("radioButtonBigLineEdit"))
        self.bigLineEdit.setVisible(False)
        
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))
        
        self.aba3 = QtGui.QWidget()
        self.aba3.setObjectName(_fromUtf8("aba_2"))
        #
        self.lineEditAvancado = QtGui.QLineEdit(self.aba3)
        self.lineEditAvancado.setGeometry(QtCore.QRect(35, 50, 600, 27))
        self.lineEditAvancado.setText(QtGui.QApplication.translate("Form", "", None, QtGui.QApplication.UnicodeUTF8))
        self.lineEditAvancado.setObjectName(_fromUtf8("radioButtonBigLineEdit"))
        #
        self.saidaAba3 = Ui_Saida()
        self.saidaAba3.setupUi(self.aba3)
        #Botao Listar Comandos
        self.botaoEnviarComando = QtGui.QPushButton(self.aba3)
        self.botaoEnviarComando.setGeometry(QtCore.QRect(35, 30, 600, 27))
        self.botaoEnviarComando.setText(QtGui.QApplication.translate("Form", "Enviar Comando", None, QtGui.QApplication.UnicodeUTF8))
        self.botaoEnviarComando.setObjectName(_fromUtf8("Enviar"))
        #Evento de Listar Comandos
        self.botaoEnviarComando.clicked.connect(self.enviarComandoAvancadoNormal)               
        self.menuDeAbas.addTab(self.aba3, _fromUtf8(""))

        self.botaoEnviarHexa = QtGui.QPushButton(self.aba3)
        self.botaoEnviarHexa.setGeometry(QtCore.QRect(35, 30, 600, 27))
        self.botaoEnviarHexa.setText(QtGui.QApplication.translate("Form", "Enviar Comando", None, QtGui.QApplication.UnicodeUTF8))
        self.botaoEnviarHexa.setObjectName(_fromUtf8("Enviar"))
        #Evento de Listar Comandos
        self.botaoEnviarHexa.clicked.connect(self.enviarComandoAvancadoHexa)               
        self.menuDeAbas.addTab(self.aba3, _fromUtf8(""))



        self.menuDeAbas.addTab(self.aba3, _fromUtf8(""))
        
        self.botaoRobo0 = QtGui.QPushButton(self)
        self.botaoRobo0.setGeometry(QtCore.QRect(430, 7, 97, 27))
        self.botaoRobo0.clicked.connect(self.robo0)         
        self.botaoRobo0.setVisible(False)      
   

        self.botaoRobo1 = QtGui.QPushButton(self)
        self.botaoRobo1.setGeometry(QtCore.QRect(530, 7, 97, 27))
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
        self.menuDeAbas.setCurrentIndex(0)
        QtCore.QMetaObject.connectSlotsByName(self)
        
        #Tamanho da janela principal MainWidget
        self.resize(700, 400)

    def enviarComandoAvancadoNormal(self):
        print "oi"
    
    def enviarComandoAvancadoHexa(self):
        print "oi"

    def metododoDoMenuDeAbas(self, Form):
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba1), QtGui.QApplication.translate("Form", "Movimentos Basicos", None, QtGui.QApplication.UnicodeUTF8))
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba2), QtGui.QApplication.translate("Form", "Lista de Comandos", None, QtGui.QApplication.UnicodeUTF8))
        self.menuDeAbas.setTabText(self.menuDeAbas.indexOf(self.aba3), QtGui.QApplication.translate("Form", "Avancado", None, QtGui.QApplication.UnicodeUTF8))

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
        self.zerarVariaveis()
        self.quantosComandos = "quantoscomandos"
        self.exibeComando = "exibecomando"
        self.printDeComandos = ''
        self.arrayResposta = []
        self.arrayMensagem = []
        #Funcao especifica para o tamanho do quantoscomandos
        MainWidget.tamanho = self.instanciaFuncoes.contarTamanhoQuantosComandos(MainWidget.destinatario, self.quantosComandos, MainWidget.remetente)
        #Criar mensagem para fazer checksum
        MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + self.quantosComandos + ' ' + MainWidget.remetente + ' '
        MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
        #Mensagem pronta + checksum
        MainWidget.mensagem = MainWidget.mensagem + self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
        
        self.arrayMensagem.append(MainWidget.mensagem)
        
        delay = 0.1
        self.arrayResposta.append(self.instanciaFuncoes.enviar_mensagem(MainWidget.Serial, MainWidget.mensagem, delay))

        
        numeroDeComandos = self.arrayResposta[0].split(" ")[3]
             
        printDeComandos = ''
        numero = int(numeroDeComandos)
        for n in range (1, numero + 1):
            self.zerarVariaveis()
            
            MainWidget.tamanho = self.instanciaFuncoes.contarTamanhoExibeComando(MainWidget.destinatario, self.exibeComando, str(n), MainWidget.remetente)
            MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + self.exibeComando + ' ' + str(n) + ' ' + MainWidget.remetente + ' '
            MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
            MainWidget.mensagem = MainWidget.mensagem + MainWidget.checksum
            self.arrayMensagem.append(MainWidget.mensagem)
            delay = 0.1
            self.arrayResposta.append(self.instanciaFuncoes.enviar_mensagem(MainWidget.Serial, MainWidget.mensagem, delay))
        
        for n in range (numero + 1):
            printDeComandos = printDeComandos + ("mensagem: " + self.arrayMensagem[n] + "\n" + "resposta: " + self.arrayResposta[n] + "\n")
        
        
        #Imprime todos os comandos de Mensagem seguido de suas Respostas
        print printDeComandos
        self.saidaAba2.imprimirSaida(printDeComandos)
        
        del self.arrayResposta[0]
        
        self.zerarListasDeParametrosDeComandos()
        
        for i in range(numero):
            MainWidget.listaComandos.append(self.arrayResposta[i].split(" ")[3])
            MainWidget.listaParametrosInteiros.append(self.arrayResposta[i].split(" ")[4])
            MainWidget.listaParametrosFloat.append(self.arrayResposta[i].split(" ")[5])
            MainWidget.listaParametrosChar.append(self.arrayResposta[i].split(" ")[6])
        
        self.boxMenu.clear()
        
        self.radioButton1 = QtGui.QRadioButton(self.aba2)
        self.radioButton1.setGeometry(QtCore.QRect(35, 110, 116, 22))
        self.radioButton1.setText(QtGui.QApplication.translate("Form", "RadioButton", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButton1.setObjectName(_fromUtf8("radioButton"))
        self.radioButton1.show()
        
        self.radioButton2 = QtGui.QRadioButton(self.aba2)
        self.radioButton2.setGeometry(QtCore.QRect(35, 130, 116, 22))
        self.radioButton2.setText(QtGui.QApplication.translate("Form", "RadioButton", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButton2.setObjectName(_fromUtf8("radioButton"))
        self.radioButton2.show()
        
        self.boxMenu.addItems(MainWidget.listaComandos)

        #Botao Enviar
        self.botaoEnviar = QtGui.QPushButton(self.aba2)
        self.botaoEnviar.setGeometry(QtCore.QRect(35, 160, 97, 27))# 35, 30, 600, 27
        self.botaoEnviar.setText(QtGui.QApplication.translate("Form", "Enviar", None, QtGui.QApplication.UnicodeUTF8))
        self.botaoEnviar.setObjectName(_fromUtf8("Enviar"))
        self.botaoEnviar.show()
        ####

        self.connect(self.radioButton1, QtCore.SIGNAL("clicked(bool)"),self.connectRadioButton1)
        self.connect(self.radioButton2, QtCore.SIGNAL("clicked(bool)"),self.connectRadioButton2)
        self.botaoEnviar.clicked.connect(self.constroiMensagem)
                

        
        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(1)
        
        self.zerarVariaveis()
    
    def connectRadioButton1(self):
        self.bigLineEdit.setVisible(False)
        if (self.boxMenu.currentIndex() != self.boxMenu.setCurrentIndex(0)):
            self.boxMenu.setCurrentIndex(0)
        self.connect(self.boxMenu, QtCore.SIGNAL("currentIndexChanged(const QString&)"), self.selecaoDeComandos)
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))

        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(1)
    
    def connectRadioButton2(self):
        self.bigLineEdit.setVisible(True)
        self.deletaLineEditParametro()
        self.connect(self.boxMenu, QtCore.SIGNAL("currentIndexChanged(const QString&)"), self.lineEditParametrosExtenso)
        self.menuDeAbas.addTab(self.aba2, _fromUtf8(""))

        self.metododoDoMenuDeAbas(self)
        self.menuDeAbas.setCurrentIndex(1)
    
    def lineEditParametrosExtenso(self):
        self.deletaLineEditParametro()
        
    def selecaoDeComandos(self):
        self.xLineEdit = 160
        self.yLineEdit = 80
        self.xLabel = 160
        self.yLabel = 60        
        self.altura = 27
        self.largura = 35
        self.contInt = 0
        self.contFloat = 0
        self.contChar = 0
        self.count = 0
        if (self.listaComandos[self.boxMenu.currentIndex()]):
            
            self.deletaLineEditParametro()            
            
            
            if (self.listaParametrosInteiros[self.boxMenu.currentIndex()] > 0):
                for i in range(int(self.listaParametrosInteiros[self.boxMenu.currentIndex()])):
                    MainWidget.arrayInputsParametrosInt.append(QtGui.QLineEdit(self.aba2))
                    MainWidget.arrayInputsParametrosInt[i].setGeometry(QtCore.QRect(self.xLineEdit, self.yLineEdit, self.largura, self.altura))
                    MainWidget.arrayInputsParametrosInt[i].setObjectName(_fromUtf8("comandoInt"))
                    MainWidget.arrayInputsParametrosInt[i].show()
                    self.xLineEdit = self.xLineEdit + 40
                                        
                    MainWidget.arrayLabelsTiposParametrosInt.append(QtGui.QLabel(self.aba2))
                    MainWidget.arrayLabelsTiposParametrosInt[i].setGeometry(QtCore.QRect(self.xLabel, self.yLabel, self.largura, self.altura))
                    MainWidget.arrayLabelsTiposParametrosInt[i].setText(QtGui.QApplication.translate("lineEdit", "Int", None, QtGui.QApplication.UnicodeUTF8))
                    MainWidget.arrayLabelsTiposParametrosInt[i].setObjectName(_fromUtf8("label"))
                    MainWidget.arrayLabelsTiposParametrosInt[i].show()
                    self.xLabel = self.xLabel + 40
                    
                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count ==0)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 125
                        self.yLabel = 105
                        self.count = 1

                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count == 1)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 170
                        self.yLabel = 150
                                            
                    MainWidget.contInt = MainWidget.contInt + 1

            if (self.listaParametrosFloat[self.boxMenu.currentIndex()] > 0):
                for i in range(int(self.listaParametrosFloat[self.boxMenu.currentIndex()])):
                    MainWidget.arrayInputsParametrosFloat.append(QtGui.QLineEdit(self.aba2))
                    MainWidget.arrayInputsParametrosFloat[i].setGeometry(QtCore.QRect(self.xLineEdit, self.yLineEdit, self.largura, self.altura))
                    MainWidget.arrayInputsParametrosFloat[i].setObjectName(_fromUtf8("comandoFloat"))
                    MainWidget.arrayInputsParametrosFloat[i].show()
                    self.xLineEdit = self.xLineEdit + 40

                    MainWidget.arrayLabelsTiposParametrosFloat.append(QtGui.QLabel(self.aba2))
                    MainWidget.arrayLabelsTiposParametrosFloat[i].setGeometry(QtCore.QRect(self.xLabel, self.yLabel, self.largura, self.altura))
                    MainWidget.arrayLabelsTiposParametrosFloat[i].setText(QtGui.QApplication.translate("lineEdit", "Float", None, QtGui.QApplication.UnicodeUTF8))
                    MainWidget.arrayLabelsTiposParametrosFloat[i].setObjectName(_fromUtf8("label"))
                    MainWidget.arrayLabelsTiposParametrosFloat[i].show()
                    self.xLabel = self.xLabel + 40                    

                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count ==0)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 125
                        self.yLabel = 105
                        self.count = 1
                                                
                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count == 1)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 170
                        self.yLabel = 150
                                                
                    MainWidget.contFloat = MainWidget.contFloat + 1

            if (self.listaParametrosChar[self.boxMenu.currentIndex()] > 0):
                for i in range(int(self.listaParametrosChar[self.boxMenu.currentIndex()])):
                    MainWidget.arrayInputsParametrosChar.append(QtGui.QLineEdit(self.aba2))
                    MainWidget.arrayInputsParametrosChar[i].setGeometry(QtCore.QRect(self.xLineEdit, self.yLineEdit, self.largura, self.altura))
                    MainWidget.arrayInputsParametrosChar[i].setObjectName(_fromUtf8("comandoChar"))
                    MainWidget.arrayInputsParametrosChar[i].show()
                    self.xLineEdit = self.xLineEdit + 40

                    MainWidget.arrayLabelsTiposParametrosChar.append(QtGui.QLabel(self.aba2))
                    MainWidget.arrayLabelsTiposParametrosChar[i].setGeometry(QtCore.QRect(self.xLabel, self.yLabel, self.largura, self.altura))
                    MainWidget.arrayLabelsTiposParametrosChar[i].setText(QtGui.QApplication.translate("lineEdit", "Char", None, QtGui.QApplication.UnicodeUTF8))
                    MainWidget.arrayLabelsTiposParametrosChar[i].setObjectName(_fromUtf8("label"))
                    MainWidget.arrayLabelsTiposParametrosChar[i].show()
                    self.xLabel = self.xLabel + 40                    
                    
                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count ==0)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 125
                        self.yLabel = 105
                        self.count = 1
                    
                    if ((self.xLineEdit == 640) and (self.xLabel == 640) and (self.count == 1)):
                        self.xLineEdit = 160
                        self.xLabel = 160
                        self.yLineEdit = 170
                        self.yLabel = 150
                    
                    MainWidget.contChar = MainWidget.contChar + 1
                    
            if((self.listaParametrosInteiros[self.boxMenu.currentIndex()] == '0') and 
               (self.listaParametrosFloat[self.boxMenu.currentIndex()] == '0') and 
               (self.listaParametrosChar[self.boxMenu.currentIndex()] == '0')):
                    self.deletaLineEditParametro()
                
    def verificaValoresParametrosValidos(self):
        self.count = 0
        
        for i in range(len(MainWidget.arrayInputsParametrosInt)):
            if(MainWidget.arrayInputsParametrosInt[i].text() == None):
                self.saidaAba2.imprimirSaida("Falta preencher campos do parametro Int")
                print "entrou 1"
            else:
                self.count = self.count + 1
                        
        if (len(MainWidget.arrayInputsParametrosInt) == 0):
            self.count = self.count + 1

        for i in range(len(MainWidget.arrayInputsParametrosFloat)):
            if(MainWidget.arrayInputsParametrosFloat[i].text() == None):
                self.saidaAba2.imprimirSaida("Falta preencher campos do parametro Float")
                print "entrou 2"
            else:
                self.count = self.count + 1

            
        if (len(MainWidget.arrayInputsParametrosFloat) == 0):
            self.count = self.count + 1            
                        
        for i in range(len(MainWidget.arrayInputsParametrosChar)):
            if(MainWidget.arrayInputsParametrosChar[i].text() == None):
                self.saidaAba2.imprimirSaida("Falta preencher campos do parametro Char")
                print "entrou 3"
            else:
                self.count = self.count + 1

        if (len(MainWidget.arrayInputsParametrosChar) == 0):
                self.count = self.count + 1
                
        if(self.count == 3):
            self.constroiMensagem
        

    def constroiMensagem(self):
        self.zerarVariaveis()
        self.somaDosParametros = 0
        self.parametros = ''
        self.qtdEspacos = 4

        
        if (self.radioButton1.isChecked() == True):
            for i in range (len(MainWidget.arrayInputsParametrosInt)):
                self.somaDosParametros = self.somaDosParametros + int(str(MainWidget.arrayInputsParametrosInt[i].text()))
                self.qtdEspacos = self.qtdEspacos + 1
                
            for i in range (len(MainWidget.arrayInputsParametrosFloat)):
                self.somaDosParametros = self.somaDosParametros + int(str(MainWidget.arrayInputsParametrosFloat[i].text()))
                self.qtdEspacos = self.qtdEspacos + 1
                
            for i in range (len(MainWidget.arrayInputsParametrosChar)):
                self.somaDosParametros = self.somaDosParametros + int(str(MainWidget.arrayInputsParametrosChar[i].text()))
                self.qtdEspacos = self.qtdEspacos + 1
                
            MainWidget.tamanho = self.instanciaFuncoes.contarTamanho(MainWidget.destinatario, 
                                                                                  MainWidget.listaComandos[self.boxMenu.currentIndex()], 
                                                                                  self.somaDosParametros, 
                                                                                  MainWidget.remetente, 
                                                                                  self.qtdEspacos)
            
            MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + MainWidget.listaComandos[self.boxMenu.currentIndex()] + ' '
            
            for i in range (len(MainWidget.arrayInputsParametrosInt)):
                MainWidget.mensagem = MainWidget.mensagem + MainWidget.arrayInputsParametrosInt[i].text()
    
            for i in range (len(MainWidget.arrayInputsParametrosFloat)):
                MainWidget.mensagem = MainWidget.mensagem + MainWidget.arrayInputsParametrosFloat[i].text()
                
            for i in range (len(MainWidget.arrayInputsParametrosChar)):
                MainWidget.mensagem = MainWidget.mensagem + MainWidget.arrayInputsParametrosChar[i].text()
                
            MainWidget.mensagem = MainWidget.mensagem + ' ' + MainWidget.remetente + ' '
            MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
            MainWidget.mensagem = MainWidget.mensagem + MainWidget.checksum
            

        if (self.radioButton2.isChecked() == True):
            self.parametros = self.bigLineEdit.text()
            self.qtdEspacos = 5
            MainWidget.comando = MainWidget.listaComandos[self.boxMenu.currentIndex()]
            MainWidget.tamanho = self.instanciaFuncoes.contarTamanho(MainWidget.destinatario, 
                                                                     MainWidget.comando, 
                                                                     len(self.parametros), 
                                                                     MainWidget.remetente, 
                                                                     self.qtdEspacos)
            MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + MainWidget.comando + ' ' + self.parametros + ' ' + MainWidget.remetente + ' '
            MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
            MainWidget.mensagem = MainWidget.mensagem + MainWidget.checksum
        
        if(self.somaDosParametros > 0):
            delay = float(self.somaDosParametros)/100 + 0.2
        
        if(int(len(self.parametros)) > 0):
            delay = float(int(len(self.parametros)/100)) + 0.2
            
        if((int(len(self.parametros)) == 0) and (self.somaDosParametros == 0)):
            self.zerarVariaveis()
            self.parametros = ''
            self.qtdEspacos = 4
            MainWidget.comando = MainWidget.listaComandos[self.boxMenu.currentIndex()]
            MainWidget.tamanho = self.instanciaFuncoes.contarTamanho(MainWidget.destinatario, 
                                                                     MainWidget.comando, 
                                                                     len(self.parametros), 
                                                                     MainWidget.remetente, 
                                                                     self.qtdEspacos)
            MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + MainWidget.comando + ' ' + MainWidget.remetente + ' '
            MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
            MainWidget.mensagem = MainWidget.mensagem + MainWidget.checksum   
            
            
            delay = 1
        
        resposta = self.instanciaFuncoes.enviar_mensagem(MainWidget.Serial, MainWidget.mensagem, delay)
        self.saidaAba2.imprimirSaida("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + resposta)
            
        print MainWidget.mensagem
        self.zerarVariaveis()



    def deletaLineEditParametro(self):
        for i in range (MainWidget.contInt):
            MainWidget.arrayInputsParametrosInt[i].hide()

        for i in range (MainWidget.contFloat):
            MainWidget.arrayInputsParametrosFloat[i].hide()
                
        for i in range (MainWidget.contChar):
            MainWidget.arrayInputsParametrosChar[i].hide()

        for i in range (MainWidget.contInt):
            MainWidget.arrayLabelsTiposParametrosInt[i].hide()

        for i in range (MainWidget.contFloat):
            MainWidget.arrayLabelsTiposParametrosFloat[i].hide()
                
        for i in range (MainWidget.contChar):
            MainWidget.arrayLabelsTiposParametrosChar[i].hide()

                
        del MainWidget.arrayInputsParametrosInt [:]
        del MainWidget.arrayInputsParametrosFloat [:]
        del MainWidget.arrayInputsParametrosChar [:]
        del MainWidget.arrayLabelsTiposParametrosInt [:]
        del MainWidget.arrayLabelsTiposParametrosFloat [:]
        del MainWidget.arrayLabelsTiposParametrosChar [:]
        
        MainWidget.arrayInputsParametrosInt = []
        MainWidget.arrayInputsParametrosFloat = []
        MainWidget.arrayInputsParametrosChar = []
        MainWidget.arrayLabelsTiposParametrosInt = []
        MainWidget.arrayLabelsTiposParametrosFloat = []
        MainWidget.arrayLabelsTiposParametrosChar = []
        
        MainWidget.contInt = 0
        MainWidget.contFloat = 0
        MainWidget.contChar = 0
        
                
    def zerarListasDeParametrosDeComandos(self):
        del MainWidget.listaComandos [:]
        del MainWidget.listaParametrosInteiros [:]
        del MainWidget.listaParametrosFloat [:]
        del MainWidget.listaParametrosChar [:]
        MainWidget.listaComandos.append("~Comandos~")
        MainWidget.listaParametrosInteiros.append(None)
        MainWidget.listaParametrosFloat.append(None)
        MainWidget.listaParametrosChar.append(None)
    
    def enviar(self):
        MainWidget.distancia = self.distancia.distanciaLineEdit.text()
        MainWidget.tamanho = self.instanciaFuncoes.contarTamanhoComandoBasico(MainWidget.destinatario, MainWidget.comando, MainWidget.distancia, MainWidget.remetente)
        MainWidget.mensagem = MainWidget.destinatario + ' ' + MainWidget.tamanho + ' ' + MainWidget.comando + ' ' + MainWidget.distancia + ' ' + MainWidget.remetente + ' '
        
        #Calculo do checksum.
        MainWidget.checksum = self.instanciaFuncoes.calculachecksum(MainWidget.mensagem)
        
        
        self.lineEditAba1.tamanho.setText(str(MainWidget.tamanho))
        self.lineEditAba1.distancia.setText(str(MainWidget.distancia))
        self.lineEditAba1.checksum.setText(MainWidget.checksum)
        
        MainWidget.mensagem = MainWidget.mensagem + MainWidget.checksum
        
        delay = (float(MainWidget.distancia)/100 + 0.2)
        resposta = self.instanciaFuncoes.enviar_mensagem(MainWidget.Serial, MainWidget.mensagem, delay)
        self.saidaAba1.imprimirSaida("mensagem: " + MainWidget.mensagem + "\n" + "resposta: " + resposta)

        self.zerarVariaveis()
        
    def zerarVariaveis(self):
        MainWidget.mensagem = ''
        MainWidget.tamanho = ''
        MainWidget.remetente = 'PC'
        MainWidget.checksum = ''

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
            if (robo_porta.portstr.find("/dev/ttyACM") != -1):
                   sleep(1.5)
            mensagem = "?? 024 qualseunome PC 01750"
            resposta = self.instanciaFuncoes.enviar_mensagem(robo_porta, mensagem,  0.5)
            nome = resposta.split(" ")[3]
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
