package org.unisa.fab;


import java.io.*;
import javax.xml.parsers.*;
import javax.xml.transform.dom.*;

import org.w3c.dom.*;
import org.xml.sax.InputSource;

import java.util.*;
import javax.xml.xpath.*;

import fedora.client.FedoraClient;
import fedora.server.types.gen.*;
import fedora.server.management.FedoraAPIM;
import fedora.server.access.FedoraAPIA;
import javax.xml.transform.*;
import javax.xml.transform.stream.*;
import javax.xml.validation.Schema;
import javax.xml.validation.SchemaFactory;
import javax.xml.validation.Validator;
import org.apache.axis.types.*;


public class FedoraInterface {
	
	private  String fedoraStub ;
    private  String username ;
    private  String password ;
    private  String marcItemID;
    private  String dCItemID;
    private  String marcAlternateID;
    private  String handlePrefix;
    private  String token = "";
	private  String pid = "";
	private  FedoraClient fed ;
    private  FedoraAPIM apim;
    private  FedoraAPIA apia;
    private StringBuffer resultList= new StringBuffer("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
    

    public FedoraInterface(String configFile) {
    	try
    	{
    	ReadConfig(configFile);
    	fed = new FedoraClient(fedoraStub, username, password);
        apim = fed.getAPIM();
        apia = fed.getAPIA();
        this.token="";
    	}
    	catch(Exception excp)
    	{
    		excp.printStackTrace();
    	}
    	
    }
    
    
    
    public FedoraInterface(String configFile, String pid) {
    	this.pid=pid;
    	try
    	{
    	ReadConfig(configFile);
    	fed = new FedoraClient(fedoraStub, username, password);
        apim = fed.getAPIM();
        apia = fed.getAPIA();
        this.token="";
    	}
    	catch(Exception excp)
    	{
    		excp.printStackTrace();
    	}
    }
    
public String getPid()
    {
    	return this.pid;
    	    }


public void ReadConfig(String configFile) throws IOException
{
		ReadConfiguration read= new ReadConfiguration(configFile);
    	this.fedoraStub=read.getvalue("fedoraStub");
			this.username=read.getvalue("username");
			this.password=read.getvalue("password");
			this.marcItemID=read.getvalue("MarcItemID");
			this.dCItemID=read.getvalue("DCItemID");
			this.marcAlternateID=read.getvalue("MarcAlternateID");
			this.handlePrefix=read.getvalue("HandlePrefix");

		
    	
}

public String modifyDatastreamByValue(String pidV,  String datastreamID, String [] altID, String label, byte[] content, String state, String log)throws RuntimeException
{
   
   try
   {

      return apim.modifyDatastreamByValue(pidV, datastreamID, altID, label, "text/xml", null, content, null, null, log, false);
   }
      
       
       catch(Exception exp){FabulousException exception = new FabulousException("Failed modifying Datastream by value for PID: "+pidV+" and item ID: "+datastreamID,exp.getMessage());
       throw exception;}

   
} 

public String purgeObject(String pid, String log)
{
  
   try
   {
   	
      return apim.purgeObject(pid,log,false);
   }
       catch(Exception exp){FabulousException exception = new FabulousException("Failed purging object",exp.toString());
         throw exception;}
}


public  ObjectFields[] searchNextResults(String tokenNew)
{
try	
{
    FieldSearchResult objects = apia.resumeFindObjects(tokenNew);
    ObjectFields[] results = objects.getResultList();
	try{
		this.token=objects.getListSession().getToken();
	}
	catch (NullPointerException exp) {this.token= "";}
    return results;
}
catch(Exception exp2){
           FabulousException exception = new FabulousException("Failed searching for resumption token: "+token,exp2.toString());
           throw exception;
           }

}



public  ObjectFields[] searchResults(String term, int queryTag, int mResult)
{
try	
{

    FieldSearchQuery query = new FieldSearchQuery();
    int temp=1;
    Condition[] tempCond = new Condition[temp];
    switch(queryTag)
    {
    case 1: 
        tempCond[0] = new Condition("title",ComparisonOperator.has,term); 
        query.setConditions(tempCond);
        break;
    case 2:
        tempCond[0] = new Condition("creator",ComparisonOperator.has,term); 
        query.setConditions(tempCond);
        break;
    case 3: query.setTerms(term); break;
    }
    
    
    FieldSearchResult objects = apia.findObjects(new String[]{"pid","title","creator","type","date","state"}, new NonNegativeInteger(""+mResult) , query);
    
   
    ObjectFields[] results = objects.getResultList();
	try{
		this.token=objects.getListSession().getToken();
	}
	catch (NullPointerException exp) {this.token= "";}
    return results;
    

   
   
}
catch(Exception exp2){
           FabulousException exception = new FabulousException("Failed searching for: queryTag: "+queryTag+" with queryValue: "+term,exp2.toString());
           throw exception;
           }

}
  
public void createResultList(ObjectFields[] results)
{
	try
	{
		resultList.append("<Result>"+ System.getProperty("line.separator"));
		for(int i=0; i<results.length; i++)
		{
			resultList.append("<item>"+ System.getProperty("line.separator"));
			
			resultList.append("<pid>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getPid()+ System.getProperty("line.separator"));
			resultList.append("</pid>"+ System.getProperty("line.separator"));
			
			resultList.append("<title>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getTitle(0)+ System.getProperty("line.separator"));
			resultList.append("</title>"+ System.getProperty("line.separator"));
			
			/*
			resultList.append("<creator>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getCreator(0)+ System.getProperty("line.separator"));
			resultList.append("</creator>"+ System.getProperty("line.separator"));
			
			resultList.append("<type>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getType(0)+ System.getProperty("line.separator"));
			resultList.append("</type>"+ System.getProperty("line.separator"));
			
			resultList.append("<date>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getDate(0)+ System.getProperty("line.separator"));
			resultList.append("</date>"+ System.getProperty("line.separator"));
			*/
			resultList.append("<state>"+ System.getProperty("line.separator"));
			resultList.append(results[i].getState()+ System.getProperty("line.separator"));
			resultList.append("</state>"+ System.getProperty("line.separator"));
			
			resultList.append("</item>"+ System.getProperty("line.separator"));
		}
		resultList.append("</Result>"+ System.getProperty("line.separator"));
	}
	catch(Exception exp2){
        FabulousException exception = new FabulousException("Failed creating result list",exp2.toString());
        throw exception;
        }
}


public  byte[] getDatastream(String datastreamId)throws FabulousException, TransformerException, TransformerConfigurationException, FileNotFoundException, IOException
{
  
   try
   {
      
      return apia.getDatastreamDissemination(pid,datastreamId,null).getStream();
   }
       catch(Exception exp){
    	   FabulousException exception = new FabulousException("Failed getting Datastream with ID "+datastreamId+" and PID "+pid,exp.toString());
    	   throw exception;}

       
   
}

public  byte[] getDatastream(String pidV, String datastreamId)throws FabulousException, TransformerException, TransformerConfigurationException, FileNotFoundException, IOException
{
  
   try
   {
     
      return apia.getDatastreamDissemination(pidV,datastreamId,null).getStream();
   
   }
       catch(Exception exp){
    	   FabulousException exception = new FabulousException("Failed getting Datastream with ID "+datastreamId+" and PID "+pidV,exp.toString());
    	   throw exception;}

       
   
}

public  ArrayList getDatastreamIds(String pidValue, String state)throws FabulousException, TransformerException, TransformerConfigurationException, FileNotFoundException, IOException
{
  
   try
   {
      Datastream[] list=apim.getDatastreams(pidValue,null,null);
      int length = list.length;
      ArrayList listnames = new ArrayList();
      for(int i=0; i<length; i++)
      {
    	  if(list[i].getState().compareTo(state)==0)
    	  {
    	  listnames.add(list[i].getID());
    	  }
      }
      return listnames;
   }
       catch(Exception exp){
    	   FabulousException exception = new FabulousException("Failed getting Datastreams with pid "+pidValue,exp.toString());
    	   throw exception;}

       
   
}

public byte[] transformXML(byte[] sourcestream, String stylesheet) 
{
	try{
	
	InputStream source = new ByteArrayInputStream(sourcestream);
	StringWriter strWriter = new StringWriter();
	StreamResult result = new StreamResult(strWriter);
	
	TransformerFactory tFactory = TransformerFactory.newInstance();
	Transformer transformer = tFactory.newTransformer(new StreamSource(stylesheet));
	transformer.transform(new StreamSource(source), result);
	
	String xmlAsString=strWriter.getBuffer().toString();
	source.close();
	strWriter.close();
	return xmlAsString.getBytes("UTF-8");
	}
	catch(Exception exp){
         FabulousException exception = new FabulousException("Failed transforming source stream",exp.toString());
         throw exception;
         }
	
}

public String getToken()
{
	return this.token;
}


public  byte[]  writeFoxml(String pidLocal,  String marcxml, String dc, String label)
{              
   StringBuffer foxml = new StringBuffer();
   
   foxml.append("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
   foxml.append ("<foxml:digitalObject xmlns:foxml=\"info:fedora/fedora-system:def/foxml#\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" PID=\""+pidLocal+"\" xsi:schemaLocation=\"info:fedora/fedora-system:def/foxml# http://www.fedora.info/definitions/1/0/foxml1-0.xsd\">");
   foxml.append ("<foxml:objectProperties>");
   foxml.append ("<foxml:property NAME=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#type\" VALUE=\"FedoraObject\"></foxml:property>");
   foxml.append ("<foxml:property NAME=\"info:fedora/fedora-system:def/model#state\" VALUE=\"A\"></foxml:property>");
   foxml.append ("<foxml:property NAME=\"info:fedora/fedora-system:def/model#label\" VALUE=\""+label+"\"></foxml:property>");
   foxml.append("</foxml:objectProperties>");
   foxml.append("<foxml:datastream CONTROL_GROUP=\"X\" ID=\"DC\" STATE=\"A\" VERSIONABLE=\"true\">");
   foxml.append("<foxml:datastreamVersion ID=\"DC.0\" LABEL=\"Dublin Core\" MIMETYPE=\"text/xml\">");
   foxml.append("<foxml:xmlContent>");
   foxml.append(dc);
   foxml.append("</foxml:xmlContent>");
   foxml.append("</foxml:datastreamVersion>");
   foxml.append("</foxml:datastream>"); 
  
   foxml.append("<foxml:datastream CONTROL_GROUP=\"X\" ID=\"MARCDESC\" STATE=\"I\" VERSIONABLE=\"true\">");
   foxml.append("<foxml:datastreamVersion ID=\"MARCDESC.0\" LABEL=\"Marc21 xml\" MIMETYPE=\"text/xml\">");
   foxml.append("<foxml:xmlContent>");
   foxml.append(marcxml);
   foxml.append("</foxml:xmlContent>");
   foxml.append("</foxml:datastreamVersion>");
   foxml.append("</foxml:datastream>");
   
   foxml.append("</foxml:digitalObject>");
   return  foxml.toString().getBytes();
}

public String getNextPid(String namespace)
{
  
   try
   {
      return apim.getNextPID(new NonNegativeInteger("1"),namespace)[0];
   }
       catch(Exception exp){
         FabulousException exception = new FabulousException("Failed getting next available PID for namespace:"+namespace,exp.toString());
         throw exception;}

   
}

public String setDatastreamState(String pidValue, String itemIdValue, String stateValue, String logValue)
{
  
   try
   {
   
      return apim.setDatastreamState(pidValue, itemIdValue, stateValue, logValue);
   }
       catch(Exception exp){
         FabulousException exception = new FabulousException("Failed re-setting the state of datastreamID: "+itemIdValue+" for PID:"+pidValue,exp.toString());
         throw exception;}

   
}

public byte[] marc2dcTransform(String stylesheet, String marcxml, String pid)
{

     byte[] newDc;
     try{
     
    	 byte[] marc =marcxml.getBytes("UTF-8"); 
     newDc = transformXML(marc,stylesheet);
     
     }
     catch(Exception exp){
         FabulousException exception = new FabulousException("Failed MARCXML to DC transformation for PID "+pid,exp.toString());
         throw exception;
         }
      
      return newDc;
  
}

//used for modifying and synchronising MARC and DC
public  byte[] marc2dcTransform2(String stylesheet, String marcxml, String pid)
{
	
     try{
     
    	String handle = getHandle(pid,this.dCItemID,this.handlePrefix);
     	byte[] marc =marcxml.getBytes("UTF-8");
     	byte[] newDc = transformXML(marc,stylesheet);
     	
    
     	InputStream dcStream = new ByteArrayInputStream(newDc);
     	
     	DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
		factory.setNamespaceAware(true);
		DocumentBuilder builder = factory.newDocumentBuilder();
		Document source = builder.parse(dcStream);
		Node node = source.getDocumentElement();
	
		Element e;
		e=source.createElement("dc:identifier");
		e.appendChild(source.createTextNode(pid));
		node.appendChild(e);
		
		e=source.createElement("dc:identifier");
        e.appendChild(source.createTextNode(handle));
        node.appendChild(e);
		
		TransformerFactory tFactory = TransformerFactory.newInstance();
		Transformer transformer = tFactory.newTransformer();
		transformer.setOutputProperty(javax.xml.transform.OutputKeys.OMIT_XML_DECLARATION,"yes");
		
	
		DOMSource sourceTemp = new DOMSource(source);
		StringWriter strWriter = new StringWriter();
		StreamResult result= new StreamResult(strWriter);
		
		transformer.transform(sourceTemp, result);
		String xmlAsString = strWriter.getBuffer().toString();
		
		
		dcStream.close();
		strWriter.close();
		
		return xmlAsString.getBytes("UTF-8");
     }
     catch(Exception exp){
         FabulousException exception = new FabulousException("Failed MARCXML to DC transformation for PID "+pid,exp.toString());
         throw exception;
         }
		
     
	
}

public String processNewRecord(String pidNamespace, String marcxml, String stylesheetPath, String label)
{
	try
	{
		String pid=getNextPid(pidNamespace);
		byte[] tempDc =marc2dcTransform(stylesheetPath, marcxml,pid );
        String dc=new String(tempDc);
        //remove xml syntax out of the newly created xml
        dc=dc.substring(39);
        
        return ingestObject(writeFoxml(pid,  marcxml, dc, label));
        
           
	}
	catch (Exception exp){
        FabulousException exception = new FabulousException("Failed Processing New Record",exp.toString());
        throw exception;
        }
}


public String processModifiedRecord(String pidLocal, String marcxml, String stylesheetPath, String log)
{
	try
	{
		
        String timeM = modifyDatastreamByValue(pidLocal, this.marcItemID, new String[]{this.marcAlternateID} ,"Marc21 xml", marcxml.getBytes("UTF-8"), "I", log);
        String timeD = modifyDatastreamByValue(pidLocal, this.dCItemID,new String[]{} ,"Dublin Core", marc2dcTransform2(stylesheetPath, marcxml,pidLocal), "A", log);
        
        return "successfully modified object: "+pidLocal+" with timestamp: "+timeM+" and "+timeD;
       
           
	}
	catch (Exception exp){
        FabulousException exception = new FabulousException("Failed Processing New Record",exp.toString());
        throw exception;
        }
}

public String ingestObject(byte[] foxml) 
{
   
   try
   {
      return "Successfully ingested object: "+apim.ingest(foxml,"foxml1.0","Object added using Fabulous version 3.0");       
   }
       catch(Exception exp){
         FabulousException exception = new FabulousException("Failed ingesting Object",exp.toString());
         throw exception;}

}
public String getHandle(String pidLocal, String datastreamID, String prefix)throws RuntimeException, org.xml.sax.SAXException, javax.xml.parsers.ParserConfigurationException, IOException
{
   String handle = "";
   try{
   
      byte[] dc= getDatastream(pidLocal,datastreamID);
      InputStream input = new ByteArrayInputStream(dc);
   
      DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
      factory.setNamespaceAware(true);
      DocumentBuilder builder = factory.newDocumentBuilder();
      Document sourceDoc = builder.parse(input);
      NodeList identifiers =sourceDoc.getElementsByTagName("dc:identifier");
      for(int i=0; i<identifiers.getLength(); i++)
      {
         //String temp=identifiers.item(i).getTextContent().trim();
    	  try
          {
         String temp=identifiers.item(i).getChildNodes().item(0).getNodeValue();
         
         if(temp.contains(prefix))
         {
            handle=temp;
            break;
         }
         }
         catch(Exception E)
         {
        	 
         }
      }
   	
   }
       catch(Exception exp2){
         RuntimeException exception = new RuntimeException("ERROR: Failed getting Handle for datastream ID "+datastreamID+" and PID "+pidLocal+" and handle prefix "+prefix+" INFO: "+exp2.toString());
         throw exception;
      }
   return handle;
}

public String searchAndReplaceInDatastream(String pidLocal, String find, String replace, String log, String path)throws RuntimeException
{
   
   try
   {
      byte[] stream = getDatastream(pidLocal,this.marcItemID);
      String temp=new String(stream);
   	
      String tempNew=temp.replace(find,replace);
    
      return processModifiedRecord(pidLocal, xmlValidate(tempNew) , path, log);
     }
       catch(Exception exp2){
    	   FabulousException exception = new FabulousException("Failed search and Replace for Object PID "+pidLocal,exp2.toString());
         throw exception;}

}

public String addDatafieldInDatastream(String pidLocal, String datafield, String ind1, String ind2, ArrayList subfields, String log, String path)throws FabulousException
{
   
   try
   {
      byte[] stream = getDatastream(pidLocal,this.marcItemID);
      InputStream sourceStream = new ByteArrayInputStream(stream);
   	
   	    DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
		factory.setNamespaceAware(true);
		DocumentBuilder builder = factory.newDocumentBuilder();
		Document source = builder.parse(sourceStream);
		
		String prefix=source.getDocumentElement().getPrefix();
		NodeList node = source.getElementsByTagName(prefix+":datafield");
		
	
        
		Element e;
        e=source.createElement(prefix+":datafield");
        e.setAttribute("tag",datafield);
        e.setAttribute("ind1",ind1);
        e.setAttribute("ind2",ind2);
        
        for(int i=0;i<subfields.size();i++)
        {
        	try
        	{
        	String[] subvalue= ((String)subfields.get(i)).split("\\|");
        	Element f=source.createElement(prefix+":subfield");
        	f.setAttribute("code",subvalue[0]);
        	f.appendChild(source.createTextNode(subvalue[1]));
        	e.appendChild(f);
        	}
        	catch(Exception E)
        	{
        		
        	}
        }
        node.item(0).getParentNode().appendChild(e);
		
		TransformerFactory tFactory = TransformerFactory.newInstance();
		Transformer transformer = tFactory.newTransformer();
		transformer.setOutputProperty(javax.xml.transform.OutputKeys.OMIT_XML_DECLARATION,"yes");
		
	
		DOMSource sourceTemp = new DOMSource(source);
		StringWriter strWriter = new StringWriter();
		StreamResult result= new StreamResult(strWriter);
		
		transformer.transform(sourceTemp, result);
		String xmlAsString = strWriter.getBuffer().toString();
		
		
		sourceStream.close();
		strWriter.close();
		
		return processModifiedRecord(pidLocal, xmlValidate(xmlAsString) , path, log);
     }
       catch(Exception exp2){
    	   FabulousException exception = new FabulousException("Failed Adding Datafield for Object PID "+pidLocal,exp2.toString());
         throw exception;}

}

public String RemoveDatafieldInDatastream(String pidLocal, String marcDatafield, String log, String path)throws FabulousException
{
   try
   {
	   
    	byte[] newDc =getDatastream(pidLocal,this.marcItemID);
    	
    	InputStream dcStream = new ByteArrayInputStream(newDc);
    	
    	DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
		factory.setNamespaceAware(true);
		DocumentBuilder builder = factory.newDocumentBuilder();
		Document source = builder.parse(dcStream);
		XPath xpath = XPathFactory.newInstance().newXPath();
      	xpath.setNamespaceContext(new PersonalNamespaceContext());
      	String xxx="//marc:record/marc:datafield[@tag='"+marcDatafield+"']";
	
		NodeList condition = (NodeList)xpath.evaluate(xxx,source,XPathConstants.NODESET);
		
    	 
     	
		for(int i=condition.getLength()-1; i>=0; i--)
		{
			Node node=condition.item(i);
			node.getParentNode().removeChild(node);
		}
		
		
		TransformerFactory tFactory = TransformerFactory.newInstance();
		Transformer transformer = tFactory.newTransformer();
		transformer.setOutputProperty(javax.xml.transform.OutputKeys.OMIT_XML_DECLARATION,"yes");
		
	
		DOMSource sourceTemp = new DOMSource(source);
		StringWriter strWriter = new StringWriter();
		StreamResult result= new StreamResult(strWriter);
		
		transformer.transform(sourceTemp, result);
		String xmlAsString = strWriter.getBuffer().toString();
		
		
		dcStream.close();
		strWriter.close();
      return processModifiedRecord(pidLocal, xmlValidate(xmlAsString) , path, log);
     }
       catch(Exception exp2){
    	   FabulousException exception = new FabulousException("Failed Deleting datafield tag "+marcDatafield+" for Object PID "+pidLocal,exp2.toString());
         throw exception;}

}

public String xmlValidate(String xml) 
{
	try {
	// parse an XML document into a DOM tree
    DocumentBuilder parser = DocumentBuilderFactory.newInstance().newDocumentBuilder();
    Document document = parser.parse(new InputSource(new StringReader(xml)));
  
    
 // create a SchemaFactory capable of understanding WXS schemas
    SchemaFactory factory = SchemaFactory.newInstance("http://www.w3.org/2001/XMLSchema");

    // load a WXS schema, represented by a Schema instance
   // Source schemaFile = new StreamSource(new File("MARC21slim.xsd"));
    
    InputStream IS = Thread.currentThread().getContextClassLoader().getResourceAsStream("/org/unisa/fab/MARC21slim.xsd");
    Source schemaFile=new StreamSource(IS);
    Schema schema = factory.newSchema(schemaFile);

    // create a Validator instance, which can be used to validate an instance document
    Validator validator = schema.newValidator();

    // validate the DOM tree
    
        validator.validate(new DOMSource(document));
        return xml;
    } catch (Exception exp) {
        // instance document is invalid!
    	 FabulousException exception = new FabulousException("MARCXML validation Failed",exp.toString());
         throw exception;
         }
    	 




}

}

