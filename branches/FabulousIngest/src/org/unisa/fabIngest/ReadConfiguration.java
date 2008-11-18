/* 
 * FabulousIngest - Fedora/Arrow Batch Utility With Lots of User services Ingest Process
 * Copyright (C) 2008  University of South Australia, Library
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
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
