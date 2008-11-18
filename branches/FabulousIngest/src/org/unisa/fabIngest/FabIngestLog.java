/**
 * 
 */
package org.unisa.fabIngest;

import java.io.FileWriter;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;


/**
 * @(#)FabIngestLog
 * This	is the  class	for writing log file
 *
 * @author Prashant.Pandey@unisa.edu.au 
 * @version	1.00 2007/10/23
 */
    class FabIngestLog {
   
       public static void write(String f, String s) throws IOException {
         TimeZone tz = TimeZone.getTimeZone("EST"); // or PST, MID, etc ...
         Date now = new Date();
         DateFormat df = new SimpleDateFormat ("yyyy.MM.dd hh:mm:ss "); 
         df.setTimeZone(tz);
         String currentTime = df.format(now); 
      
         FileWriter aWriter = new FileWriter(f, true);
         aWriter.write(currentTime + " " + s 
            + System.getProperty("line.separator"));
         aWriter.flush();
         aWriter.close();
      }
       public static void write(String f, String s, String value) throws IOException { 
      
         FileWriter aWriter = new FileWriter(f, true);
         aWriter.write(" " + s 
            + System.getProperty("line.separator"));
         aWriter.flush();
         aWriter.close();
      }
   }
