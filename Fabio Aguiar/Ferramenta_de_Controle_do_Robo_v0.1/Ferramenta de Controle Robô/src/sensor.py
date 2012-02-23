# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file '/home/fabyuu/Área de trabalho/RoboLivre/QT/Ferramenta de Controle do Robô/sensor.ui'
#
# Created: Mon Feb  6 18:09:38 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Sensor(object):
    def setupUi(self, Sensor):
        Sensor.setObjectName(_fromUtf8("Sensor"))
        Sensor.resize(700, 400)
        Sensor.setWindowTitle(QtGui.QApplication.translate("Sensor", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.lcdNumber = QtGui.QLCDNumber(Sensor)
        self.lcdNumber.setGeometry(QtCore.QRect(10, 20, 141, 61))
        self.lcdNumber.setObjectName(_fromUtf8("lcdNumber"))

        self.retranslateUi(Sensor)
        QtCore.QMetaObject.connectSlotsByName(Sensor)

    def retranslateUi(self, Sensor):
        pass


if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Sensor = QtGui.QWidget()
    ui = Ui_Sensor()
    ui.setupUi(Sensor)
    Sensor.show()
    sys.exit(app.exec_())
