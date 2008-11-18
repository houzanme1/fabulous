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

import java.io.File;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

import fedora.client.FedoraClient;
import fedora.server.management.FedoraAPIM;

/**
 * @(#)CAPFileIngest.java
 * This	is the driver class	for	automatically ingesting	files into Arrow@unisa from a specified folder
 *
 * @Prashant.Pandey@unisa.edu.au 
 * @version	2.00 2007/11/16
 */
  

 public class FabIngestDriver {
   
      private static String fedoraStub;
      private static String username;
      private static String password;
      private static String ingestFolderActive;
      private static String ingestFolderInActive;      
      private static String pidNamespace;
      private static String logFileNameInitial;
      private static String contentAltID;
      private static String DataStreamID;
      private static String DataStreamLabel;
    
    /**
     * @param args the command line	arguments
     */
       public static void main(String[] args) {
        // TODO	code application logic here
        
        
         try{
         	
         	ReadConfig();
         	
         	String logfileName = logFileNameInitial+"\\log-"+getDate()+".log";
          
            
            File dirInactive = new File(ingestFolderInActive);
            File diractive = new File(ingestFolderActive);
           
           // work with Inactive Directory
            
            if (dirInactive.isDirectory()) {
               File[] files	= dirInactive.listFiles();
               int i=0;
               int count=0;
                FabIngestLog.write(logfileName, "***********************************Processing Inactive Directory*****************************************************","true");
               for(i=0;i<files.length && files[i].isFile();i++){
               
                  String fileName=files[i].getName();	
               
                  FabIngestLog.write(logfileName, "********************************************************************************","true");
                  FabIngestLog.write(logfileName, "Processing File "+fileName+" started..............");
               
                  String firstName=fileName.substring(0,fileName.lastIndexOf("."));
                  String extension=fileName.substring(fileName.lastIndexOf(".")+1,fileName.length());
                  
                 
                  String pid="";
                  String pidSuffix="";
                  for(int j=0;j<firstName.length();j++)
                  {
                     if(firstName.charAt(j) >='0' && firstName.charAt(j) <='9')	
                     {
                        pid=pid+firstName.charAt(j);
                     }
                     else
                     {
                     	pidSuffix=pidSuffix+firstName.charAt(j);
                     }
                  }
                  
                  	
                  	//get correct mimeTypes and corresponding label
                     String[] MimeLabel=getMimeType(extension);
                     String mimeType=MimeLabel[0];
                     String label=MimeLabel[1];
                     String state="I";
                   		
                     try{
                     
                        FabIngestLog.write(logfileName, "Ingesting Datastream............."+ingestDatastream(files[i],pidNamespace+":"+pid,DataStreamID+pidSuffix,mimeType,DataStreamLabel+" "+label,state,contentAltID));
                        FabIngestLog.write(logfileName, "The file "+fileName+" deleted : "+files[i].delete());
                        count ++;
                     }
                         catch(Exception excp){FabIngestLog.write(logfileName, "Processing terminated: "+excp.toString());};
                  
                
                  FabIngestLog.write(logfileName, "Processing File "+fileName+" Finished");
               }
               
               FabIngestLog.write(logfileName, "********************************************************************************","true");
               FabIngestLog.write(logfileName, " ","true");
               FabIngestLog.write(logfileName, "--------------------------------------------------------------------------------","true");
                    
               FabIngestLog.write(logfileName, ""+count+" Files Successfully processed out of "+i+" Files Present","true");
           	   FabIngestLog.write(logfileName, "--------------------------------------------------------------------------------","true");   
           	   
               FabIngestLog.write(logfileName, " ","true");
           	   FabIngestLog.write(logfileName, "*******************************Finished Processing Inactive Directory************************************************","true");
              
            }
            else{
               FabIngestLog.write(logfileName, "The	directory "+dirInactive+" does not exist");
            }
            
            
            // work with Active Directory
            
            if (diractive.isDirectory()) {
               File[] files	= diractive.listFiles();
               int i=0;
               int count=0;
               FabIngestLog.write(logfileName, " ","true");
               FabIngestLog.write(logfileName, " ","true");
               FabIngestLog.write(logfileName, " ","true");
               FabIngestLog.write(logfileName, " ","true");
                  
               FabIngestLog.write(logfileName, "************************************Processing active Directory******************************************************","true");
              for(i=0;i<files.length && files[i].isFile();i++){
               
                  String fileName=files[i].getName();	
               
                  FabIngestLog.write(logfileName, "********************************************************************************","true");
                  FabIngestLog.write(logfileName, "Processing File "+fileName+" started..............");
               
                  String firstName=fileName.substring(0,fileName.lastIndexOf("."));
                  String extension=fileName.substring(fileName.lastIndexOf(".")+1,fileName.length());
                  
                 
                  
                  
                  String pid="";
                  String pidSuffix="";
                  for(int j=0;j<firstName.length();j++)
                  {
                     if(firstName.charAt(j) >='0' && firstName.charAt(j) <='9')	
                     {
                        pid=pid+firstName.charAt(j);
                     }
                     else
                     {
                     	pidSuffix=pidSuffix+firstName.charAt(j);
                     }
                  }
                  	
                  	//get correct mimeTypes and corresponding label
                  
                     String[] MimeLabel=getMimeType(extension);
                     String mimeType=MimeLabel[0];
                     String label=MimeLabel[1];
                     String state="A";
                   		
                     try{
                     
                        FabIngestLog.write(logfileName, "Ingesting Datastream............."+ingestDatastream(files[i],pidNamespace+":"+pid,DataStreamID+pidSuffix,mimeType,DataStreamLabel+" "+label,state,contentAltID));
                        FabIngestLog.write(logfileName, "The file "+fileName+" deleted : "+files[i].delete());
                        count ++;
                     }
                         catch(Exception excp){FabIngestLog.write(logfileName, "Processing terminated: "+excp.toString());};
                  
                  	
                 
                 
                  
                  
                  
               
                  
                  FabIngestLog.write(logfileName, "Processing File "+fileName+" Finished");
               }
               
               FabIngestLog.write(logfileName, "********************************************************************************","true");
                  FabIngestLog.write(logfileName, " ","true");
               
                  FabIngestLog.write(logfileName, "--------------------------------------------------------------------------------","true");    
               FabIngestLog.write(logfileName, ""+count+" Files Successfully processed out of "+i+" Files Present","true");
             FabIngestLog.write(logfileName, "--------------------------------------------------------------------------------","true");      
           FabIngestLog.write(logfileName, " ","true");
            FabIngestLog.write(logfileName, "********************************Finished Processing active Directory*************************************************","true");
                 
            }
            else{
               FabIngestLog.write(logfileName, "The	directory "+diractive+" does not exist");
            }
            
            
            
            
         
           
            
         }
             catch(IOException exp1)
            {
               exp1.printStackTrace();
            }
        
      }
  /**
   *  Reading the parameters from the Properties File FabulousIngest.properties
   * @throws IOException
   */    
      
       public static void ReadConfig() throws IOException
      {
         ReadConfiguration read= new ReadConfiguration("settings/FabulousIngest.properties");
    	 
         fedoraStub =read.getvalue("fedoraStub");
      	 username = read.getvalue("fedoraUsername");
     	 password =read.getvalue("fedoraPassword");
     	 pidNamespace =read.getvalue("pidNamespace");
     	 contentAltID=read.getvalue("contentAltID");
     	 
     	 
    	 ingestFolderActive =read.getvalue("ingestFolderActive");
    	 ingestFolderInActive =read.getvalue("ingestFolderInActive");
      	
         logFileNameInitial=read.getvalue("logFileNameInitial");
         
         DataStreamID=read.getvalue("DataStreamID");
      	 DataStreamLabel=read.getvalue("DataStreamLabel");
        
         
         
        }
  /**
   * Gets the Mime Type and Label for the given file extension 
   * @param file extension as string
   * @return String[] with MimeType and Label
   */    
      
       public static String[] getMimeType(String extension)
      {
         String mimeType="";
         String label="FULL TEXT";
         if(extension.equalsIgnoreCase("xml")==true) mimeType="text/xml";
         else if(extension.equalsIgnoreCase("txt")==true) mimeType="text/plain";
         else if(extension.equalsIgnoreCase("rtf")==true) mimeType="text/rtf";
         else if(extension.equalsIgnoreCase("pdf")==true) mimeType="application/pdf";
         else if(extension.equalsIgnoreCase("ps")==true) mimeType="application/postscript";
         else if(extension.equalsIgnoreCase("xls")==true) mimeType="application/ms-excel";
         else if(extension.equalsIgnoreCase("ppt")==true) mimeType="application/ms-powerpoint";
         else if(extension.equalsIgnoreCase("doc")==true) mimeType="application/ms-word";
         else if(extension.equalsIgnoreCase("zip")==true){ mimeType="application/zip";label="COMPRESSED CONTENT";}
         else if(extension.equalsIgnoreCase("jpeg")==true){ mimeType="image/jpeg";label="IMAGE";}
         else if(extension.equalsIgnoreCase("jpg")==true){ mimeType="image/jpeg";label="IMAGE";}
         else if(extension.equalsIgnoreCase("gif")==true){ mimeType="image/gif";label="IMAGE";}
         else if(extension.equalsIgnoreCase("bmp")==true){ mimeType="image/bmp";label="IMAGE";}
         else if(extension.equalsIgnoreCase("png")==true){ mimeType="image/png";label="IMAGE";}
         else if(extension.equalsIgnoreCase("tiff")==true){mimeType="image/tiff";label="IMAGE";}
         else if(extension.equalsIgnoreCase("tif")==true){mimeType="image/tiff";label="IMAGE";}
         else if(extension.equalsIgnoreCase("mp3")==true){ mimeType="audio/mpeg";label="AUDIO";}
         else if(extension.equalsIgnoreCase("wav")==true){ mimeType="audio/x-wav";label="AUDIO";}
         else if(extension.equalsIgnoreCase("mp2")==true){mimeType="video/mpeg";label="VIDEO";}
         else if(extension.equalsIgnoreCase("mpeg")==true){ mimeType="video/mpeg";label="VIDEO";}
         else if(extension.equalsIgnoreCase("qt")==true){ mimeType="video/quicktime";label="VIDEO";}
         else if(extension.equalsIgnoreCase("mov")==true){ mimeType="video/quicktime";label="VIDEO";}
         else System.out.println("invalid extension");
                  
         return new String[]{mimeType,label};
      }
      
     
    
    /**
     * Get formatted Current system Date
     * @return String
     */
   
    
       public static String getDate()
      {
         Date now = new Date();
         DateFormat df = new SimpleDateFormat ("yyyy-MM-dd'T'hh-mm-ss");
         String currentTime = df.format(now);
         return currentTime; 
      
      }
   
       
   
    
    
    
       public static String ingestDatastream(File file, String pid, String datastreamId, String mimeType, String label, String state, String contentAltId)throws RuntimeException
      {
         String value="";
         try
         {
         
            FedoraClient fed = new FedoraClient(fedoraStub, username, password);
            FedoraAPIM apim = fed.getAPIM();
            String tempURI = fed.uploadFile(file); 
           // String ferdoraPid=pidNamespace+":"+pid;
           String ferdoraPid=pid;
            String datastreamvalue=apim.addDatastream(ferdoraPid,datastreamId,new String[]{contentAltId},label,true,mimeType,null,tempURI,"M",state,null,null,"Datastream added using BORSAClient");     
            value="Successfully ingested Datastream: "+ferdoraPid+" CONTENT: "+file.getName()+" ID: "+datastreamvalue; 
         }
             catch(Exception exp3){RuntimeException exception = new RuntimeException("Failed ingesting Datastream, Error: "+exp3.toString());
               throw exception;}
      
         return value;
      }
      
      
      	
      	
      
   
   }