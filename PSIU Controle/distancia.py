# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file '/home/fabyuu/Área de trabalho/RoboLivre/QT/Ferramenta de Controle do Robô/distancia.ui'
#
# Created: Thu Feb  9 16:04:38 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_distancia(object):
    def setupUi(self, distancia):
        distancia.setObjectName(_fromUtf8("distancia"))
        distancia.resize(700, 400)
        distancia.setWindowTitle(QtGui.QApplication.translate("distancia", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.distanciaLineEdit = QtGui.QLineEdit(distancia)
        self.distanciaLineEdit.setGeometry(QtCore.QRect(500, 90, 61, 27))
        self.distanciaLineEdit.setObjectName(_fromUtf8("distanciaLineEdit"))
        self.label = QtGui.QLabel(distancia)
        self.label.setGeometry(QtCore.QRect(500, 70, 67, 17))
        self.label.setText(QtGui.QApplication.translate("distancia", "Distância", None, QtGui.QApplication.UnicodeUTF8))
        self.label.setObjectName(_fromUtf8("label"))
        
        
        self.retranslateUi(distancia)
        QtCore.QMetaObject.connectSlotsByName(distancia)

    def retranslateUi(self, distancia):
        pass


if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    distancia = QtGui.QWidget()
    ui = Ui_distancia()
    ui.setupUi(distancia)
    distancia.show()
    sys.exit(app.exec_())
