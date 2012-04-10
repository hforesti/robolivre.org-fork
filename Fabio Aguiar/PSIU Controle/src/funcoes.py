from time import sleep
import serial
import glob

class Funcoes(object):

    def scan(self):
        return glob.glob('/dev/ttyU*') +  glob.glob('/dev/ttyA*')
    
        
    def  enviar_mensagem(self, robo_porta, mensagem, delay):
            robo_porta.write(str(mensagem))
            sleep(delay)
            resposta = ''
            while (robo_porta.inWaiting() > 0):
                resposta = resposta + robo_porta.read() 
       
            return resposta
    
    
    
    def calculachecksum(self, mensagem):
        checksum = 0
        for i in range(len(mensagem)):
                checksum = checksum + ord(str(mensagem[i]))       
        
        checksum2 = str(checksum)    
        
        if len(str(checksum)) < 5:
            for i in range(5 - len(str(checksum))):
                checksum2 = '0' + checksum2
     
        return checksum2
    
    
    
    def contarTamanhoComandoBasico(self, destinatario, comando, distancia, remetente):
        tamanho = 0
        tamanho = len(destinatario) +  len(comando)  + len(distancia) + len(remetente) + 13
        
        tamanho2 = str(tamanho)
        
        if (len(tamanho2) < 3):
            tamanho2 = '0' + tamanho2
        
        return tamanho2
    
    def contarTamanhoQuantosComandos(self, destinatario, quantosComandos, remetente):
        tamanho = 0
        tamanho = len(destinatario) + len(quantosComandos) + len(remetente) + 12
        
        tamanho2 = str(tamanho)
        
        if (len(tamanho2) < 3):
            tamanho2 = '0' + tamanho2
        
        return tamanho2
    
    
    def contarTamanhoExibeComando(self, destinatario, exibeComandos, numeroDoComando, remetente):
        tamanho = 0
        tamanho = len(destinatario) + len(exibeComandos) + len(numeroDoComando) + len(remetente) + 13
        
        tamanho2 = str(tamanho)
        
        if (len(tamanho2) < 3):
            tamanho2 = '0' + tamanho2
        
        return tamanho2
    
    
    def contarTamanho(self, destinatario, comando, somaDosParametros, remetente, qtdEspacos):
        tamanho = 0 
        tamanho = len(destinatario) + len(comando) + somaDosParametros + len(remetente) + qtdEspacos + 8
        
        
        tamanho2 = str(tamanho)
        
        if (len(tamanho2) < 3):
            tamanho2 = '0' + tamanho2
        
        return tamanho2