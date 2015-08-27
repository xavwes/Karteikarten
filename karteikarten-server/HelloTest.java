import org.junit.*; 
// by FYICenter.com
public class HelloTest { 
    @Test public void testHello() {
        String message = "Hello World!";
        Assert.assertEquals(12, message.length());
    }
    
    @Test
	public void register(){
		// Registrieren service mit neuem Benutzer
		StringBuilder url_request = new StringBuilder("http://h2467150.stratoserver.net/register.php?registername=newUser&registerpassword=newUserPassword");
            url_request.append(params[0]);

            Log.i("url", url_request.toString());
            HttpClient httpClient = new DefaultHttpClient();

            HttpGet httpGet = new HttpGet(url_request.toString());
            HttpResponse getResponse = httpClient.execute(httpGet);
            
             
            assertEquals("user"+":"+"added", getResponse);
			
		// Registrieren service mit bestehendem Benutzer
		
		StringBuilder url_request = new StringBuilder("http://h2467150.stratoserver.net/register.php?registername=user1&registerpassword=test");
            url_request.append(params[0]);

            Log.i("url", url_request.toString());
            HttpClient httpClient = new DefaultHttpClient();

            HttpGet httpGet = new HttpGet(url_request.toString());
            HttpResponse getResponse = httpClient.execute(httpGet);
            
            
            assertEquals("user"+":"+"exists", getResponse);
	}
}
