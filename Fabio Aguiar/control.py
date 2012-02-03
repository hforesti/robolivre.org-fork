# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file '/home/fabyuu/Área de trabalho/RoboLivre/QT/Ferramenta de Controle do Robô/control.ui'
#
# Created: Wed Feb  1 15:35:17 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Control(object):
    def setupUi(self, Control):
        Control.setObjectName(_fromUtf8("Control"))
        Control.resize(319, 150)
        Control.setWindowTitle(QtGui.QApplication.translate("Control", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.Control_2 = QtGui.QWidget(Control)
        self.Control_2.setGeometry(QtCore.QRect(10, 10, 301, 131))
        self.Control_2.setObjectName(_fromUtf8("Control_2"))
        self.paraFrente = QtGui.QPushButton(self.Control_2)
        self.paraFrente.setGeometry(QtCore.QRect(100, 20, 97, 27))
        self.paraFrente.setText(QtGui.QApplication.translate("Control", "Para Frente", None, QtGui.QApplication.UnicodeUTF8))
        self.paraFrente.setObjectName(_fromUtf8("paraFrente"))
        self.paraTraz = QtGui.QPushButton(self.Control_2)
        self.paraTraz.setGeometry(QtCore.QRect(100, 80, 97, 27))
        self.paraTraz.setText(QtGui.QApplication.translate("Control", "Para Traz", None, QtGui.QApplication.UnicodeUTF8))
        self.paraTraz.setObjectName(_fromUtf8("paraTraz"))
        self.giraDireita = QtGui.QPushButton(self.Control_2)
        self.giraDireita.setGeometry(QtCore.QRect(200, 50, 97, 27))
        self.giraDireita.setText(QtGui.QApplication.translate("Control", "Gira Direita", None, QtGui.QApplication.UnicodeUTF8))
        self.giraDireita.setObjectName(_fromUtf8("giraDireita"))
        self.giraEsquerda = QtGui.QPushButton(self.Control_2)
        self.giraEsquerda.setGeometry(QtCore.QRect(0, 50, 97, 27))
        self.giraEsquerda.setText(QtGui.QApplication.translate("Control", "Gira Esquerda", None, QtGui.QApplication.UnicodeUTF8))
        self.giraEsquerda.setObjectName(_fromUtf8("giraEsquerda"))

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

