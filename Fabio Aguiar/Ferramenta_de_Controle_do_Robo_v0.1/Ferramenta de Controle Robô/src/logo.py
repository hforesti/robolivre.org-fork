from PyQt4 import QtCore, QtGui

class Ui_Logo(object):
    def setupUi(self, Logo):
        #Teste de Imagem
        self.hbox = QtGui.QHBoxLayout(Logo)
        self.pixmap = QtGui.QPixmap("robo.png")
        self.lbl = QtGui.QLabel(Logo)
        self.lbl.setGeometry(QtCore.QRect(0, 0, 150, 30))
        self.lbl.setPixmap(self.pixmap)
        self.lbl.setScaledContents(True)
        Logo.resize(700, 400)

if __name__ == "__main__":
    import sys
    app = QtGui.QApplication(sys.argv)
    Logo = QtGui.QWidget()
    ui = Ui_Logo()
    ui.setupUi(Logo)
    Logo.show()
    sys.exit(app.exec_())