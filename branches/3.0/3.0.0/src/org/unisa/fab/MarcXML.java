package org.unisa.fab;


import java.io.*;
import java.util.*;
/*
import java.io.IOException;
import java.net.*;

import javax.xml.parsers.ParserConfigurationException;
*/
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import javax.xml.validation.*;

import org.w3c.dom.Document;
import org.xml.sax.*;

import javax.xml.transform.Source;
import javax.xml.transform.dom.*;
import javax.xml.transform.stream.StreamSource;




public class MarcXML {
	
	
	
	private Hashtable hash;
	private StringBuffer buffer= new StringBuffer();
	String leader="";
	ArrayList controlFields=new ArrayList();
	ArrayList dataFields= new ArrayList();
	
	public MarcXML(Hashtable hash)
	{
		this.hash=hash;
		buffer.append("<marc:collection xmlns:marc=\"http://www.loc.gov/MARC21/slim\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.loc.gov/MARC21/slim http://www.loc.gov/standards/marcxml/schema/MARC21slim.xsd\">");
		buffer.append("<marc:record>");
		processMarcXML();
		buffer.append("<marc:leader>"+leader+"</marc:leader>");
		/*
		for(int i=0;i<controlFields.size();i++)
		{
		buffer.append(((ControlField)controlFields.get(i)).getXml());
		}
		*/
		 //fix for the control fields being displayed in reverse order Date:17/06/2008
		for(int i=controlFields.size()-1;i>=0;i--)
		{
		buffer.append(((ControlField)controlFields.get(i)).getXml());
		}
		/*
		for(int j=0;j<dataFields.size();j++)
		{
			buffer.append(((DataField)dataFields.get(j)).getXml());
		}
		*/
		 //fix for the data fields being displayed in reverse order Date:17/06/2008
		for(int j=dataFields.size()-1;j>=0;j--)
		{
			buffer.append(((DataField)dataFields.get(j)).getXml());
		}
		buffer.append("</marc:record>");
		buffer.append("</marc:collection>");
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
	
	
	public void processMarcXML()
	{
		
	
		leader=(String)hash.get("leader");
		
		
		Enumeration keys = hash.keys();
		
		 while(keys.hasMoreElements()) {
		      
			 String key = (String)keys.nextElement();
			 String value= (String)hash.get(key);
			 
			 if (key.startsWith("controlfieldTag")== true)
			 {
				 String temp[] = key.split("_");
				 String count = temp[1];
				 String anotherKey= "controlfieldValue_"+count;
				 String anotherValue= (String)hash.get(anotherKey);
				 controlFields.add(new ControlField(value,anotherValue));
			 }
			 else if (key.startsWith("datafieldTag")==true)
			 {
				 ArrayList subList= new ArrayList();
				 String temp[] = key.split("_");
					 String count = temp[1];
					 String ind1Key= "datafieldInd1_"+count;
					 String ind2Key= "datafieldInd2_"+count;
					 String ind1Value= (String)hash.get(ind1Key);
					 String ind2Value= (String)hash.get(ind2Key);
						
					 Enumeration keys2 = hash.keys();
						
						 while(keys2.hasMoreElements()) {
							 
							 String key1 = (String)keys2.nextElement();
							 String value1= (String)hash.get(key1);
							 
							 if (key1.startsWith("subfield_"+count+"_")==true)
							 {
								 
								 String temp1[] = key1.split("_");
									 String counter = temp1[2];
									 String anotherKey= "subvalue_"+count+"_"+counter;
									 String anotherValue= (String)hash.get(anotherKey);
									 
									
									 subList.add(new Subfield(value1, anotherValue));
									 
								 }
							 
						 }
					 
					 
					 dataFields.add(new DataField(value,ind1Value, ind2Value, subList));
			 }
			 
			 
			 
		    }
		
		
		
	}
	
	public String getMarcXML()
	{
	
		return xmlValidate(buffer.toString());
	}

}

class DataField {
	
	private String tag;
	private String ind1;
	private String ind2;
	private ArrayList subFieldList;
	
	public DataField()
	{
		
	}
	public DataField(String tag, String ind1, String ind2)
	{
		this.tag=tag;
		this.ind1=ind1;
		this.ind2=ind2;
		subFieldList= new ArrayList();
	}
	
	public DataField(String tag, String ind1, String ind2, ArrayList subFieldList)
	{
		this.tag=tag;
		this.ind1=ind1;
		this.ind2=ind2;
		this.subFieldList=subFieldList;
	}
	
	public String getTag()
	{
		return this.tag;
	}
	public String getInd1()
	{
		return this.ind1;
	}
	public String getInd2()
	{
		return this.ind2;
	}
	
	public void setTag(String tag)
	{
		this.tag=tag;
	}
	
	public void setInd1(String ind1)
	{
		this.ind1=ind1;
	}
	
	public void setInd2(String ind2)
	{
		this.ind2=ind2;
	}
	
	public void appendSub(Subfield sub)
	{
		this.subFieldList.add(sub);
	}
	
	public String toString()
	{
	 return this.tag+":"+this.ind1+":"+this.ind2;
	}
	
	public String getXml()
	{
	 StringBuffer buf = new StringBuffer("");
	 buf.append("<marc:datafield tag=\""+this.tag+"\" ind1=\""+this.ind1+"\" ind2=\""+this.ind2+"\">");
	 
	 /*
	 for(int j=0;j<subFieldList.size();j++)
		{
			buf.append(((Subfield)subFieldList.get(j)).getXml());
		}
	 */
	 //fix for the subfield being displayed in reverse order Date:17/06/2008
	 for(int j=subFieldList.size()-1;j>=0;j--)
		{
			buf.append(((Subfield)subFieldList.get(j)).getXml());
		}
	 
	 
	 buf.append("</marc:datafield>");
	 
	 return buf.toString();
	}
	
}

class ControlField{
	private String tag;
	private String value;
	
	public ControlField()
	{
	}
	
	public ControlField(String tag, String value)
	{
		this.tag=tag;
		this.value=value;
	}
	
	public String getTag()
	{
		return this.tag;
	}
	public String getValue()
	{
		return this.value;
	}
	
	public void setTag(String tag)
	{
		this.tag=tag;
	}
	
	public void setValue(String value)
	{
		this.value=value;
	}
	
	public String toString()
	{
	 return this.tag+"="+this.value;
	}
	
	public String getXml()
	{
	 return "<marc:controlfield tag=\""+this.tag+"\">"+this.value+"</marc:controlfield>";
	}
}

class Subfield{
	
	private String tag;
	private String value;
	
	public Subfield()
	{
	}
	
	public Subfield(String tag, String value)
	{
		this.tag=tag;
		this.value=value;
	}
	
	public String getTag()
	{
		return this.tag;
	}
	public String getValue()
	{
		return this.value;
	}
	
	public void setTag(String tag)
	{
		this.tag=tag;
	}
	
	public void setValue(String value)
	{
		this.value=value;
	}
	
	public String toString()
	{
	 return this.tag+"="+this.value;
	}
	
	public String getXml()
	{
	 return "<marc:subfield code=\""+this.tag+"\">"+this.value+"</marc:subfield>";
	}
	
}