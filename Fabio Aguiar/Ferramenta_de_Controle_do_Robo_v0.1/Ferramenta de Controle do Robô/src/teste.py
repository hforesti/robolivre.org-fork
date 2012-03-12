# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'untitled.ui'
#
# Created: Tue Mar  6 15:11:02 2012
#      by: PyQt4 UI code generator 4.8.5
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Form(object):
    def setupUi(self, Form):
        lista = list()
        a = "qasfv"
        b = "qsdjd"
        c = "dkhcb"
        #lista = [a, b, c]
        #lista2 = list(array)
        array = []
        array.append("oi")
        array.append("xau")
        print array[0]
        print array[1]
        
        Form.setObjectName(_fromUtf8("Form"))
        Form.resize(264, 97)
        Form.setWindowTitle(QtGui.QApplication.translate("Form", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.comboBox = QtGui.QComboBox(Form)
        self.comboBox.setGeometry(QtCore.QRect(30, 30, 85, 27))
        self.comboBox.setObjectName(_fromUtf8("comboBox"))
        #self.comboBox.addItems(lista2)
        
        
        self.retranslateUi(Form)
        QtCore.QMetaObject.connectSlotsByName(Form)

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
