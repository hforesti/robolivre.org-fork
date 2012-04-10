from PyQt4 import QtCore, QtGui

class Ui_Logo(object):
    def setupUi(self, Logo):
        #Teste de Imagem
        self.hbox = QtGui.QHBoxLayout(Logo)
        self.pixmap = QtGui.QPixmap("imagens/logo/robo.png")
        self.lbl = QtGui.QLabel(Logo)
<<<<<<< HEAD
        self.lbl.setGeometry(QtCore.QRect(15, 0, 165, 50))
=======
        self.lbl.setGeometry(QtCore.QRect(15, 0, 150, 30))
>>>>>>> a5baba1e01a1c55f6e9ae81c400c70ec2ff70b5a
        self.lbl.setPixmap(self.pixmap)
        self.lbl.setScaledContents(True)
        
        self.nomeFerramentaDeControle = QtGui.QLabel(Logo)
        self.nomeFerramentaDeControle.setText(QtGui.QApplication.translate("lineEdit", "FERRAMENTA DE CONTROLE", None, QtGui.QApplication.UnicodeUTF8))
        self.nomeFerramentaDeControle.setGeometry(QtCore.QRect(170, 5, 300, 30))
        
        Logo.resize(700, 400)
        
        
        
        
if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Logo = QtGui.QWidget()
    ui = Ui_Logo()
    ui.setupUi(Logo)
    Logo.show()
    sys.exit(app.exec_())
