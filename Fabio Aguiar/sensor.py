# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file '/home/fabyuu/Área de trabalho/RoboLivre/QT/Ferramenta de Controle do Robô/sensor.ui'
#
# Created: Wed Feb  1 15:35:00 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Sensor(object):
    def setupUi(self, Sensor):
        Sensor.setObjectName(_fromUtf8("Sensor"))
        Sensor.resize(166, 151)
        Sensor.setWindowTitle(QtGui.QApplication.translate("Sensor", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.Sensor_2 = QtGui.QWidget(Sensor)
        self.Sensor_2.setGeometry(QtCore.QRect(10, 10, 141, 121))
        self.Sensor_2.setObjectName(_fromUtf8("Sensor_2"))
        self.ligado = QtGui.QRadioButton(self.Sensor_2)
        self.ligado.setGeometry(QtCore.QRect(10, 10, 76, 20))
        self.ligado.setText(QtGui.QApplication.translate("Sensor", "Ligado", None, QtGui.QApplication.UnicodeUTF8))
        self.ligado.setObjectName(_fromUtf8("ligado"))
        self.desligado = QtGui.QRadioButton(self.Sensor_2)
        self.desligado.setGeometry(QtCore.QRect(10, 30, 97, 22))
        self.desligado.setText(QtGui.QApplication.translate("Sensor", "Desligado", None, QtGui.QApplication.UnicodeUTF8))
        self.desligado.setObjectName(_fromUtf8("desligado"))
        self.lcdNumber = QtGui.QLCDNumber(self.Sensor_2)
        self.lcdNumber.setGeometry(QtCore.QRect(0, 60, 141, 61))
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

