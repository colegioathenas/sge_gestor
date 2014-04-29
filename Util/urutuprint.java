import java.applet.Applet;
import java.awt.Graphics;
import java.io.*;
import java.io.PrintWriter;
import java.lang.InterruptedException;
import java.net.*;
import java.util.Locale;
import java.util.Date;

public class urutuprint extends Applet
{
  public void paint(Graphics g)
  {
    String modelo = this.getParameter("modelo");
    String p1	  = this.getParameter("p1");
    String p2	  = this.getParameter("p2");
    String p3     = this.getParameter("p3");
    String p4     = this.getParameter("p4");
    String p5     = this.getParameter("p5");
    try{
       FileOutputStream outputfile = null;
       outputfile = new FileOutputStream("COM6");
       if (outputfile == null){
	  outputfile = new FileOutputStream("Bematech_COM6");
       }
       /* 
       BufferedWriter bw = new BufferedWriter(fw);
       bw.write("   Instituto Athenas");
       bw.newLine();
       bw.write("     SOLICITACAO");
       bw.newLine();
       bw.write("Nome: ");
       bw.write(p1);
       bw.newLine();
       bw.write("CPF: ");
       bw.write(p2);
       bw.newLine();
       bw.write("Protocolo: ");
       bw.write(p5);
       bw.newLine();
       bw.write(" ============================= ");
       bw.close();
       fw.close();
       */
       PrintWriter out = new PrintWriter(outputfile);
       out.println(p1);
       out.println(p2);
       out.println(p3);
       out.println(p4);
       out.println(p5);
       out.close();
       outputfile.close();
    }catch(Exception ex){
	g.drawString(ex,100,25);
    }
    g.drawString("Imprimindo Solicitacao "+modelo+".",200,50);
    /*try{
       Runtime rt = Runtime.getRuntime();
       Process pr = rt.exec("lp -d BEMA1 /tmp/teste.txt");
       try{
         pr.waitFor();
       }catch(InterruptedException ie){}

       try{
          getAppletContext().showDocument(new URL("javascript:voltar()"));
       }catch(MalformedURLException me){
       }
    }catch(IOException e){
       g.drawString("Erro",100,25);
    }*/
  }
}
