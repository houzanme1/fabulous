/**
 * 
 */
package org.unisa.fabIngest;


import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

/**
 * @author Prashant.Pandey@unisa.edu.au
 * @(#)ReadConfiguration
 * This	is the  class for reading configuration file
 *
 * @version	1.00 2007/12/04
 *
 */
public class ReadConfiguration {
	
	Properties properties;
    String filename;
 
     public ReadConfiguration(String filename) throws IOException
    {
       properties = new Properties();
       this.filename=filename;
       InputStream inputStream = this.getClass().getClassLoader().getResourceAsStream(filename);
       properties.load(inputStream);
    }
 
 
 
     public String getvalue(String key)
    {
       return properties.getProperty(key);
    }
 
     public String getvalue(String key, String Default)
    {
       return properties.getProperty(key,Default);
    }
 

}
