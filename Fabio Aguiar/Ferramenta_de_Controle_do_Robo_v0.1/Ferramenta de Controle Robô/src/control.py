# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file '/home/fabyuu/Área de trabalho/RoboLivre/QT/Ferramenta de Controle do Robô/control.ui'
#
# Created: Mon Feb  6 18:06:49 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Control(object):
    def setupUi(self, Control):
        Control.setObjectName(_fromUtf8("Control"))
        Control.resize(700, 400)
        Control.setWindowTitle(QtGui.QApplication.translate("Control", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.paraFrente = QtGui.QPushButton(Control)
        self.paraFrente.setGeometry(QtCore.QRect(110, 70, 40, 50))
        #self.paraFrente.setText(QtGui.QApplication.translate("Control", "Para Frente", None, QtGui.QApplication.UnicodeUTF8))
        self.iconFrente = QtGui.QIcon("imagens/setas/1/up1.png")
        self.paraFrente.setIcon(self.iconFrente)
        self.paraFrente.setObjectName(_fromUtf8("paraFrente"))
        self.giraEsquerda = QtGui.QPushButton(Control)
        self.giraEsquerda.setGeometry(QtCore.QRect(60, 110, 50, 40))
        #self.giraEsquerda.setText(QtGui.QApplication.translate("Control", "Gira Esquerda", None, QtGui.QApplication.UnicodeUTF8))
        self.iconEsquerda = QtGui.QIcon("imagens/setas/1/left1.png")
        self.giraEsquerda.setIcon(self.iconEsquerda)
        self.giraEsquerda.setObjectName(_fromUtf8("giraEsquerda"))
        self.giraDireita = QtGui.QPushButton(Control)
        self.giraDireita.setGeometry(QtCore.QRect(150, 110, 50, 40))
        #self.giraDireita.setText(QtGui.QApplication.translate("Control", "Gira Direita", None, QtGui.QApplication.UnicodeUTF8))
        self.iconDireita = QtGui.QIcon("imagens/setas/1/right1.png")
        self.giraDireita.setIcon(self.iconDireita)
        self.giraDireita.setObjectName(_fromUtf8("giraDireita"))
        self.paraTras = QtGui.QPushButton(Control)
        self.paraTras.setGeometry(QtCore.QRect(110, 140, 40, 50))
        #self.paraTras.setText(QtGui.QApplication.translate("Control", "Para Tras", None, QtGui.QApplication.UnicodeUTF8))
        self.iconTras = QtGui.QIcon("imagens/setas/1/down1.png")
        self.paraTras.setIcon(self.iconTras)
        self.paraTras.setObjectName(_fromUtf8("paraTras"))

        
        self.retranslateUi(Control)
        QtCore.QMetaObject.connectSlotsByName(Control)

    def retranslateUi(self, Control):
        pass
    
if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Control = QtGui.QWidget()
    ui = Ui_Control()
    ui.setupUi(Control)
    Control.show()
    sys.exit(app.exec_())
