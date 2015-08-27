import org.junit.*;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.junit.Test;

// by FYICenter.com
public class HelloTest {
	/*
    @Test public void testHello() {
        String message = "Hello World!";
        Assert.assertEquals(12, message.length());
    }
    */
    @Test
	public void register(){
		// Registrieren service mit neuem Benutzer
		StringBuilder url_request = new StringBuilder("http://h2467150.stratoserver.net/register.php?registername=newUser&registerpassword=newUserPassword");


            Log.i("url", url_request.toString());
            HttpClient httpClient = new DefaultHttpClient();

            HttpGet httpGet = new HttpGet(url_request.toString());
            HttpResponse getResponse = httpClient.execute(httpGet);
            
             
            assertEquals("user"+":"+"added", getResponse);
			
		// Registrieren service mit bestehendem Benutzer
		
		StringBuilder url_request2 = new StringBuilder("http://h2467150.stratoserver.net/register.php?registername=user1&registerpassword=test");


            Log.i("url", url_request2.toString());
            HttpClient httpClient2 = new DefaultHttpClient();

            HttpGet httpGet2 = new HttpGet(url_request2.toString());
            HttpResponse getResponse2 = httpClient2.execute(httpGet2);
            
            
            assertEquals("user"+":"+"exists", getResponse2);
	}
}
