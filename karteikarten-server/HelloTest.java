import org.junit.*;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.junit.Test;

// by FYICenter.com
public class HelloTest {

    @Test public void register(){
		// Registrieren service mit neuem Benutzer
		URL url;
		// URL aufbauen
		url = new URL("http://h2467150.stratoserver.net/register.php?registername=newUser&registerpassword=newUserPassword");
		// verbindung herstellen
		URLConnection con = url.openConnection();
		// Antwort als InputStream aufnehmen
		InputStream in = con.getInputStream();
		// Encoding rausfinden
		String encoding = con.getContentEncoding();
		encoding = encoding == null ? "UTF-8" : encoding;
		//encoden
		String body = IOUtils.toString(in, encoding);
            
            	assertTrue(body.contains("added"));
			
		// Registrieren service mit bestehendem Benutzer
		url = new URL("http://h2467150.stratoserver.net/register.php?registername=user1&registerpassword=test");
		// verbindung herstellen
		con = url.openConnection();
		// Antwort als InputStream aufnehmen
		in = con.getInputStream();
		// Encoding rausfinden
		encoding = con.getContentEncoding();
		encoding = encoding == null ? "UTF-8" : encoding;
		//encoden
		body = IOUtils.toString(in, encoding);
            	
	        assertTrue(body.contains("exists"));
	}
}
