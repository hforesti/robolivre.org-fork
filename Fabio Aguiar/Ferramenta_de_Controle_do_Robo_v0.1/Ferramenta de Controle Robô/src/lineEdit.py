#!/usr/bin/python
# -*- coding: UTF-8 -*-
from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_lineEdit(object):
    def setupUi(self, lineEdit):
        nomeDoRobo = ''
        tamanho = ''
        comando = ''
        distancia = ''
        remetente = 'PC'
        checksum = ''
        
        #ABA 1
        lineEdit.setObjectName(_fromUtf8("lineEdit"))
        lineEdit.resize(700, 400)
        lineEdit.setWindowTitle(QtGui.QApplication.translate("lineEdit", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.nomeDoRobo = QtGui.QLineEdit(lineEdit)
        self.nomeDoRobo.setGeometry(QtCore.QRect(20, 30, 101, 27))
        self.nomeDoRobo.setObjectName(_fromUtf8("nomeDoRobo"))
        self.label = QtGui.QLabel(lineEdit)
        self.label.setGeometry(QtCore.QRect(20, 10, 101, 17))
        self.label.setText(QtGui.QApplication.translate("lineEdit", "Nome do Robô", None, QtGui.QApplication.UnicodeUTF8))
        self.label.setObjectName(_fromUtf8("label"))
        self.label_2 = QtGui.QLabel(lineEdit)
        self.label_2.setGeometry(QtCore.QRect(140, 10, 67, 17))
        self.label_2.setText(QtGui.QApplication.translate("lineEdit", "Tamanho", None, QtGui.QApplication.UnicodeUTF8))
        self.label_2.setObjectName(_fromUtf8("label_2"))
        self.label_3 = QtGui.QLabel(lineEdit)
        self.label_3.setGeometry(QtCore.QRect(300, 10, 67, 17)) #Comando
        self.label_3.setText(QtGui.QApplication.translate("lineEdit", "Comando", None, QtGui.QApplication.UnicodeUTF8))
        self.label_3.setObjectName(_fromUtf8("label_3"))
        self.label_4 = QtGui.QLabel(lineEdit)
        self.label_4.setGeometry(QtCore.QRect(515, 10, 81, 17))
        self.label_4.setText(QtGui.QApplication.translate("lineEdit", "Remetente", None, QtGui.QApplication.UnicodeUTF8))
        self.label_4.setObjectName(_fromUtf8("label_4"))
        self.label_5 = QtGui.QLabel(lineEdit)
        self.label_5.setGeometry(QtCore.QRect(595, 10, 71, 17))
        self.label_5.setText(QtGui.QApplication.translate("lineEdit", "Checksum", None, QtGui.QApplication.UnicodeUTF8))
        self.label_5.setObjectName(_fromUtf8("label_5"))
        self.tamanho = QtGui.QLineEdit(lineEdit)
        self.tamanho.setGeometry(QtCore.QRect(130, 30, 81, 27))
        self.tamanho.setObjectName(_fromUtf8("tamanho"))
        self.comando = QtGui.QLineEdit(lineEdit)
        self.comando.setGeometry(QtCore.QRect(220, 30, 211, 27))
        self.comando.setObjectName(_fromUtf8("comando"))
        self.remetente = QtGui.QLineEdit(lineEdit)
        self.remetente.setGeometry(QtCore.QRect(520, 30, 61, 27))
        self.remetente.setObjectName(_fromUtf8("remetente"))
        self.checksum = QtGui.QLineEdit(lineEdit)
        self.checksum.setGeometry(QtCore.QRect(593, 30, 71, 27))
        self.checksum.setObjectName(_fromUtf8("checksum"))
        self.label_6 = QtGui.QLabel(lineEdit)
        self.label_6.setGeometry(QtCore.QRect(445, 10, 67, 17))
        self.label_6.setText(QtGui.QApplication.translate("lineEdit", "Distância", None, QtGui.QApplication.UnicodeUTF8))
        self.label_6.setObjectName(_fromUtf8("label_6"))
        self.distancia = QtGui.QLineEdit(lineEdit)
        self.distancia.setGeometry(QtCore.QRect(440, 30, 71, 27))
        self.distancia.setObjectName(_fromUtf8("distancia"))
        
        self.nomeDoRobo.setText(nomeDoRobo)
        self.tamanho.setText(tamanho)
        self.comando.setText(comando)
        self.distancia.setText(distancia)
        self.remetente.setText(remetente)
        self.checksum.setText(checksum)
        
        self.nomeDoRobo.setDisabled(True)
        self.tamanho.setDisabled(True)
        self.comando.setDisabled(True)
        self.distancia.setDisabled(True)
        self.remetente.setDisabled(True)
        self.checksum.setDisabled(True)
        
        self.retranslateUi(lineEdit)
        QtCore.QMetaObject.connectSlotsByName(lineEdit)

    def setupUi2(self, lineEdit):
        nomeDoRobo = ''
        tamanho = ''
        comando = ''
        distancia = ''
        remetente = ''
        checksum = ''

        #ABA 2
        
        self.radioButtonBigLineEdit = QtGui.QRadioButton(lineEdit)
        self.radioButtonBigLineEdit.setGeometry(QtCore.QRect(60, 60, 131, 22))
        self.radioButtonBigLineEdit.setText(QtGui.QApplication.translate("Form", "RadioButton1", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButtonBigLineEdit.setObjectName(_fromUtf8("radioButtonBigLineEdit"))
        self.radioButtonCutLineEdit = QtGui.QRadioButton(lineEdit)
        self.radioButtonCutLineEdit.setGeometry(QtCore.QRect(60, 110, 141, 22))
        self.radioButtonCutLineEdit.setText(QtGui.QApplication.translate("Form", "RadioButton2", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButtonCutLineEdit.setObjectName(_fromUtf8("radioButtonCutLineEdit"))
        
        
        self.radioButtonBigLineEdit.clicked.connect(self.clickedRadioButton1)
            
            
        self.nomeDoRobo = QtGui.QLineEdit(lineEdit)
        self.nomeDoRobo.setGeometry(QtCore.QRect(20, 30, 101, 27))
        self.nomeDoRobo.setObjectName(_fromUtf8("nomeDoRobo"))
        self.label = QtGui.QLabel(lineEdit)
        self.label.setGeometry(QtCore.QRect(20, 10, 101, 17))
        self.label.setText(QtGui.QApplication.translate("lineEdit", "Nome do Robo", None, QtGui.QApplication.UnicodeUTF8))
        self.label.setObjectName(_fromUtf8("label"))
        self.label_2 = QtGui.QLabel(lineEdit)
        self.label_2.setGeometry(QtCore.QRect(140, 10, 67, 17))
        self.label_2.setText(QtGui.QApplication.translate("lineEdit", "Tamanho", None, QtGui.QApplication.UnicodeUTF8))
        self.label_2.setObjectName(_fromUtf8("label_2"))
        self.label_3 = QtGui.QLabel(lineEdit)
        self.label_3.setGeometry(QtCore.QRect(300, 10, 67, 17)) #Comando
        self.label_3.setText(QtGui.QApplication.translate("lineEdit", "Comando", None, QtGui.QApplication.UnicodeUTF8))
        self.label_3.setObjectName(_fromUtf8("label_3"))
        self.label_4 = QtGui.QLabel(lineEdit)
        self.label_4.setGeometry(QtCore.QRect(515, 10, 81, 17))
        self.label_4.setText(QtGui.QApplication.translate("lineEdit", "Remetente", None, QtGui.QApplication.UnicodeUTF8))
        self.label_4.setObjectName(_fromUtf8("label_4"))
        self.label_5 = QtGui.QLabel(lineEdit)
        self.label_5.setGeometry(QtCore.QRect(595, 10, 71, 17))
        self.label_5.setText(QtGui.QApplication.translate("lineEdit", "Checksum", None, QtGui.QApplication.UnicodeUTF8))
        self.label_5.setObjectName(_fromUtf8("label_5"))
        self.tamanho = QtGui.QLineEdit(lineEdit)
        self.tamanho.setGeometry(QtCore.QRect(130, 30, 81, 27))
        self.tamanho.setObjectName(_fromUtf8("tamanho"))
        self.comando = QtGui.QLineEdit(lineEdit)
        self.comando.setGeometry(QtCore.QRect(220, 30, 211, 27))
        self.comando.setObjectName(_fromUtf8("comando"))
        self.remetente = QtGui.QLineEdit(lineEdit)
        self.remetente.setGeometry(QtCore.QRect(520, 30, 61, 27))
        self.remetente.setObjectName(_fromUtf8("remetente"))
        self.checksum = QtGui.QLineEdit(lineEdit)
        self.checksum.setGeometry(QtCore.QRect(593, 30, 71, 27))
        self.checksum.setObjectName(_fromUtf8("checksum"))
        self.label_6 = QtGui.QLabel(lineEdit)
        self.label_6.setGeometry(QtCore.QRect(445, 10, 67, 17))
        self.label_6.setText(QtGui.QApplication.translate("lineEdit", "Distancia", None, QtGui.QApplication.UnicodeUTF8))
        self.label_6.setObjectName(_fromUtf8("label_6"))
        self.distancia = QtGui.QLineEdit(lineEdit)
        self.distancia.setGeometry(QtCore.QRect(440, 30, 71, 27))
        self.distancia.setObjectName(_fromUtf8("distancia"))
        
        self.nomeDoRobo.setText(nomeDoRobo)
        self.tamanho.setText(tamanho)
        self.comando.setText(comando)
        self.distancia.setText(distancia)
        self.remetente.setText(remetente)
        self.checksum.setText(checksum)
                
        
        self.retranslateUi(lineEdit)
        QtCore.QMetaObject.connectSlotsByName(lineEdit)        
        
    def clickedRadioButton1(self):
        print "oi"
    
    def retranslateUi(self, lineEdit):
        pass
        

if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    lineEdit = QtGui.QWidget()
    ui = Ui_lineEdit()
    ui.setupUi(lineEdit)
    lineEdit.show()
    sys.exit(app.exec_())
