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
        
        Form.setObjectName(_fromUtf8("Form"))
        Form.resize(163, 68)
        Form.setWindowTitle(QtGui.QApplication.translate("Form", "Form", None, QtGui.QApplication.UnicodeUTF8))
        
        self.radioButton1 = QtGui.QRadioButton()
        self.radioButton1.setGeometry(QtCore.QRect(35, 110, 116, 22))
        self.radioButton1.setText(QtGui.QApplication.translate("Form", "RadioButton", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButton1.setObjectName(_fromUtf8("radioButton"))
        #self.radioButton1.show()
        
        self.radioButton2 = QtGui.QRadioButton()
        self.radioButton2.setGeometry(QtCore.QRect(35, 130, 116, 22))
        self.radioButton2.setText(QtGui.QApplication.translate("Form", "RadioButton", None, QtGui.QApplication.UnicodeUTF8))
        self.radioButton2.setObjectName(_fromUtf8("radioButton"))
        self.radioButton2.show()
        
        
        
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
