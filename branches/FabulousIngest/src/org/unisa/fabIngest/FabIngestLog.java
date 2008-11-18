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
