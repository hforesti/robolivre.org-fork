from PyQt4 import QtCore, QtGui

class Ui_Logo(object):
    def setupUi(self, Logo):
        #Teste de Imagem
        self.hbox = QtGui.QHBoxLayout(Logo)
        self.pixmap = QtGui.QPixmap("imagens/logo/robo.png")
        self.lbl = QtGui.QLabel(Logo)
        self.lbl.setGeometry(QtCore.QRect(15, 0, 150, 30))
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