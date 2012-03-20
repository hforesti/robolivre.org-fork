from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_Saida(object):
    texto = ''
    def setupUi(self, Form):
        Form.setObjectName(_fromUtf8("Form"))
        Form.resize(700, 400)
        Form.setWindowTitle(QtGui.QApplication.translate("Form", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.textEdit = QtGui.QTextEdit(Form)
        self.textEdit.setGeometry(QtCore.QRect(-1, 200, 680, 100))
        self.textEdit.setObjectName(_fromUtf8("textEdit"))
        self.textEdit.setReadOnly(True)
        
        self.retranslateUi(Form)
        QtCore.QMetaObject.connectSlotsByName(Form)        
        
    def imprimirSaida(self, stringProtocol):
        self.textEdit.setText(stringProtocol)
        
    def retranslateUi(self, Form):
        pass


if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Form = QtGui.QWidget()
    ui = Ui_Saida()
    ui.setupUi(Form)
    Form.show()
    sys.exit(app.exec_())