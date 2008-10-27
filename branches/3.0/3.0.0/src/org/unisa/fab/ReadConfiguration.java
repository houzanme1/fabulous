package org.unisa.fab;

/**
 * @(#)ReadConfiguration
 * This	is the  class for reading configuration file
 *
 * @Prashant.Pandey@unisa.edu.au 
 * @version	1.00 2007/12/04
 */

import java.util.Properties;
import java.io.*;

public class ReadConfiguration
{
	
	Properties properties;
	
	public ReadConfiguration(String filename) throws IOException
	{
		properties = new Properties();
		properties.load(new FileInputStream(filename));
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