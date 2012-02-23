from PyQt4 import QtCore, QtGui

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    _fromUtf8 = lambda s: s

class Ui_lineEdit(object):
    def setupUi(self, lineEdit):
        nomeDoRobo = 'MNERIM'
        tamanho = ''
        comando = ''
        distancia = ''
        remetente = 'PC'
        checksum = ''
        
        lineEdit.setObjectName(_fromUtf8("lineEdit"))
        lineEdit.resize(711, 153)
        lineEdit.setWindowTitle(QtGui.QApplication.translate("lineEdit", "Form", None, QtGui.QApplication.UnicodeUTF8))
        self.nomeDoRobo = QtGui.QLineEdit(lineEdit)
        self.nomeDoRobo.setGeometry(QtCore.QRect(10, 90, 101, 27))
        self.nomeDoRobo.setObjectName(_fromUtf8("nomeDoRobo"))
        self.label = QtGui.QLabel(lineEdit)
        self.label.setGeometry(QtCore.QRect(10, 70, 101, 17))
        self.label.setText(QtGui.QApplication.translate("lineEdit", "Nome do Robo", None, QtGui.QApplication.UnicodeUTF8))
        self.label.setObjectName(_fromUtf8("label"))
        self.label_2 = QtGui.QLabel(lineEdit)
        self.label_2.setGeometry(QtCore.QRect(140, 70, 67, 17))
        self.label_2.setText(QtGui.QApplication.translate("lineEdit", "Tamanho", None, QtGui.QApplication.UnicodeUTF8))
        self.label_2.setObjectName(_fromUtf8("label_2"))
        self.label_3 = QtGui.QLabel(lineEdit)
        self.label_3.setGeometry(QtCore.QRect(310, 70, 67, 17))
        self.label_3.setText(QtGui.QApplication.translate("lineEdit", "Comando", None, QtGui.QApplication.UnicodeUTF8))
        self.label_3.setObjectName(_fromUtf8("label_3"))
        self.label_4 = QtGui.QLabel(lineEdit)
        self.label_4.setGeometry(QtCore.QRect(540, 70, 81, 17))
        self.label_4.setText(QtGui.QApplication.translate("lineEdit", "Remetente", None, QtGui.QApplication.UnicodeUTF8))
        self.label_4.setObjectName(_fromUtf8("label_4"))
        self.label_5 = QtGui.QLabel(lineEdit)
        self.label_5.setGeometry(QtCore.QRect(630, 70, 71, 17))
        self.label_5.setText(QtGui.QApplication.translate("lineEdit", "Checksum", None, QtGui.QApplication.UnicodeUTF8))
        self.label_5.setObjectName(_fromUtf8("label_5"))
        self.tamanho = QtGui.QLineEdit(lineEdit)
        self.tamanho.setGeometry(QtCore.QRect(130, 90, 81, 27))
        self.tamanho.setObjectName(_fromUtf8("tamanho"))
        self.comando = QtGui.QLineEdit(lineEdit)
        self.comando.setGeometry(QtCore.QRect(230, 90, 211, 27))
        self.comando.setObjectName(_fromUtf8("comando"))
        self.remetente = QtGui.QLineEdit(lineEdit)
        self.remetente.setGeometry(QtCore.QRect(550, 90, 61, 27))
        self.remetente.setObjectName(_fromUtf8("remetente"))
        self.checksum = QtGui.QLineEdit(lineEdit)
        self.checksum.setGeometry(QtCore.QRect(630, 90, 71, 27))
        self.checksum.setObjectName(_fromUtf8("checksum"))
        self.label_6 = QtGui.QLabel(lineEdit)
        self.label_6.setGeometry(QtCore.QRect(460, 70, 67, 17))
        self.label_6.setText(QtGui.QApplication.translate("lineEdit", "Distancia", None, QtGui.QApplication.UnicodeUTF8))
        self.label_6.setObjectName(_fromUtf8("label_6"))
        self.distancia = QtGui.QLineEdit(lineEdit)
        self.distancia.setGeometry(QtCore.QRect(460, 90, 71, 27))
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
