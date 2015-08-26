import org.junit.*; 
// by FYICenter.com
public class HelloTest { 
    @Test public void testHello() {
        String message = "Hello World!";
        Assert.assertEquals(12, message.length());
    }
}
