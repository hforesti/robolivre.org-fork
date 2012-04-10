# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'untitled.ui'
#
# Created: Tue Mar  6 15:11:02 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui
#from dbus.decorators import signal
#from invest import sleep
from time import sleep
try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Form(object):
    def setupUi(self, Form):
        
        array = []
        
        array.append(QtGui.QLineEdit(Ui_Form))
        array[0].setGeometry(QtCore.QRect(10, 10, 10, 10))
        array[0].setObjectName(_fromUtf8("comandoInt"))
        array[0].show()


        
        
    def teste(self):
        print "oi"
    

    def retranslateUi(self, Form):
        pass


if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Form = QtGui.QWidget()
    ui = Ui_Form()
    ui.setupUi(Form)
    Form.show()
    sys.exit(app.exec_())
