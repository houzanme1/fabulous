package org.unisa.fab;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Enumeration;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import fedora.server.types.gen.ObjectFields;

/**
 * Servlet implementation class for Servlet: DiaplaySearchResults
 *
 */
 public class DisplaySearchResults extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
    /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public DisplaySearchResults() {
		super();
	}   	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}  	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
		response.setContentType("text/html;charset=UTF-8");
		
		String buttonValue = request.getParameter("submit");
		
		String output="";
		
		StringBuffer str= new StringBuffer("");
		
		ObjectFields[] results = null;
		String[] prevSelection=null;
		
		String title="";
		String heading="";
		
		String searchString = "";
        String searchTag = "";
        String maxResults = "";
        int queryTag;
        int mResult;
        
        String token = "";
        int processValue = 0 ;
        FedoraInterface fed = new FedoraInterface(getServletContext().getRealPath("/WEB-INF/settings")+"/fabulous.properties");
		
        
       try
        {
		
		if(buttonValue.compareToIgnoreCase("search")==0 || buttonValue.compareToIgnoreCase("next")==0)
		{
			 String path =request.getContextPath();
			 if(buttonValue.compareToIgnoreCase("search")==0)
			{
				searchString = request.getParameter("searchString").toString();
		        searchTag = request.getParameter("QueryTag").toString();
		        maxResults = request.getParameter("MaxResults").toString();
		        processValue = Integer.parseInt(request.getParameter("processaction").toString());
		        queryTag=Integer.parseInt(searchTag);
		        mResult=Integer.parseInt(maxResults);
		        
		        
		        results=fed.searchResults(searchString, queryTag, mResult);
		        token=fed.getToken();
		        
		        
			}
			else if(buttonValue.compareToIgnoreCase("next")==0)
			{
				token = request.getParameter("token").toString();
				processValue= Integer.parseInt(request.getParameter("processaction").toString());
				results=fed.searchNextResults(token);
				token=fed.getToken();
				
			}
			
			
			
			
			
			
			if(results.length>0)
	        {
	        	
				str.append("<form action=\"DisplaySearchResults\" method=\"POST\">");
				try
				{
				prevSelection =request.getParameterValues("checkedPids");
				  for(int i=0; i<prevSelection.length; i++) {
		            	str.append("<input type=\"hidden\" name=\"prevSelection\" value=\""+prevSelection[i]+"\"/>");
		        		
			          }
				}
				catch(Exception E)
				{
				//log here
				}
				try
				{
				  String [] prevSelection2 =request.getParameterValues("prevSelection");
				  for(int i=0; i<prevSelection2.length; i++) {
		            	str.append("<input type=\"hidden\" name=\"prevSelection\" value=\""+prevSelection2[i]+"\"/>");
		        		
			          }
				}
				catch(Exception E)
				{
					//log here
				}
				if(token!="")
	    		{
	            str.append("<input type=\"hidden\" name=\"token\" value=\""+token+"\"/>");
	            }
	            str.append("<input type=\"hidden\" name=\"processaction\" value=\""+processValue+"\"/>");
			
			switch(processValue)
            {
            case 1:{
            	if(token!="")
	    		{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"Activate\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
            		str.append("</div>");
	    		}
            	else
            	{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"Activate\"/>");
            		str.append("</div>");
            	}
            	
    		str.append("<table class=\"tabledata\"><thead><tr><th>Pid</th><th>Inactive Datastreams</th><th>Title</th><th>Author(s)</th><th>Type</th><th>Date</th><th>State</th></tr></thead>");
            
    		for(int i=0; i<results.length; i++)
    		{
    			String pid = results[i].getPid();
    			ArrayList datastreamList=fed.getDatastreamIds(pid,"I");
    			
    			str.append("<td><a href=\""+path+"/DisplayMarcxmlAsFormServlet?pid="+pid+"\">"+pid+"</a></td>");
    			str.append("<td>");
    			for(int k=0; k<datastreamList.size();k++)
    			{
    			String id=(String)datastreamList.get(k);
    			String value=pid+"|"+id;
    			str.append("<input type=\"checkbox\" name=\"checkedPids\" value=\""+value+"\"/>"+id+"<br>");
    			//str.append(""+(String)datastreamList.get(k)+"</ul>");
    			}
    			str.append("</td>");

    			
    			try{
    			str.append("<td>"+results[i].getTitle(0)+"</td>");
    			}
    			catch(Exception E)
    			{
    			str.append("<td></td>");
    			}
    			try{
    				str.append("<td>"+results[i].getCreator(0)+"</td>");
        			}
        			catch(Exception E)
        			{
        			str.append("<td></td>");
        			}
        			try{
        				str.append("<td>"+results[i].getType(0)+"</td>");
            			}
            			catch(Exception E)
            			{
            			str.append("<td></td>");
            			}
            			try{
            				str.append("<td>"+results[i].getDate(0)+"</td>");
                			}
                			catch(Exception E)
                			{
                			str.append("<td></td>");
                			}
    			str.append("<td>"+results[i].getState()+"</td></tr>");
    			
    		}
    		str.append("</table>");	
    		
    		if(token!="")
    		{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"Activate\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
        		str.append("</div>");
    		}
        	else
        	{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"Activate\"/>");
        		str.append("</div>");
        	}
    		break;}
            case 2:{
            	
            	if(token!="")
	    		{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"de-activate\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
            		str.append("</div>");
	    		}
            	else
            	{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"de-activate\"/>");
            		str.append("</div>");
            	}
            	 
                
            	str.append("<table class=\"tabledata\"><thead><tr><th>Pid</th><th>Active Datastreams</th><th>Title</th><th>Author(s)</th><th>Type</th><th>Date</th><th>State</th></tr></thead>");
            
    		for(int i=0; i<results.length; i++)
    		{
    			String pid = results[i].getPid();
    			ArrayList datastreamList=fed.getDatastreamIds(pid,"A");
    			
    			str.append("<td><a href=\""+path+"/DisplayMarcxmlAsFormServlet?pid="+pid+"\">"+pid+"</a></td>");
    			str.append("<td>");
    			for(int k=0; k<datastreamList.size();k++)
    			{
    				String id=(String)datastreamList.get(k);
        			String value=pid+"|"+id;
        			str.append("<input type=\"checkbox\" name=\"checkedPids\" value=\""+value+"\"/>"+id+"<br>");
        			
    			}
    			str.append("</td>");
    			
    			try{
        			str.append("<td>"+results[i].getTitle(0)+"</td>");
        			}
        			catch(Exception E)
        			{
        			str.append("<td></td>");
        			}
        			try{
        				str.append("<td>"+results[i].getCreator(0)+"</td>");
            			}
            			catch(Exception E)
            			{
            			str.append("<td></td>");
            			}
            			try{
            				str.append("<td>"+results[i].getType(0)+"</td>");
                			}
                			catch(Exception E)
                			{
                			str.append("<td></td>");
                			}
                			try{
                				str.append("<td>"+results[i].getDate(0)+"</td>");
                    			}
                    			catch(Exception E)
                    			{
                    			str.append("<td></td>");
                    			}
        			str.append("<td>"+results[i].getState()+"</td></tr>");
    			
    		}
    		str.append("</table>");	
    		
    		if(token!="")
    		{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"de-activate\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
        		str.append("</div>");
    		}
        	else
        	{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"de-activate\"/>");
        		str.append("</div>");
        	}
    		break;}
            case 3:{
            	
            	
            	if(token!="")
	    		{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-edit\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
            		str.append("</div>");
	    		}
            	else
            	{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-edit\"/>");
            		str.append("</div>");
            	}
            	 
                 
         	
            	str.append("<table class=\"tabledata\"><thead><tr><th>Select</th><th>Pid</th><th>Title</th><th>Author(s)</th><th>Type</th><th>Date</th><th>State</th></tr></thead>");
            
            	
    		for(int i=0; i<results.length; i++)
    		{
    			String pid = results[i].getPid();
    			str.append("<tr><td><input type=\"checkbox\" name=\"checkedPids\" value=\""+pid+"\"/></td>");
    			str.append("<td><a href=\""+path+"/DisplayMarcxmlAsFormServlet?pid="+pid+"\">"+pid+"</a></td>");
    			try{
        			str.append("<td>"+results[i].getTitle(0)+"</td>");
        			}
        			catch(Exception E)
        			{
        			str.append("<td></td>");
        			}
        			try{
        				str.append("<td>"+results[i].getCreator(0)+"</td>");
            			}
            			catch(Exception E)
            			{
            			str.append("<td></td>");
            			}
            			try{
            				str.append("<td>"+results[i].getType(0)+"</td>");
                			}
                			catch(Exception E)
                			{
                			str.append("<td></td>");
                			}
                			try{
                				str.append("<td>"+results[i].getDate(0)+"</td>");
                    			}
                    			catch(Exception E)
                    			{
                    			str.append("<td></td>");
                    			}
        			str.append("<td>"+results[i].getState()+"</td></tr>");
    			
    		}
    		str.append("</table>");	
    		
    		if(token!="")
    		{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-edit\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
        		str.append("</div>");
    		}
        	else
        	{
        		str.append("<div id=\"data\">");
                str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-edit\"/>");
        		str.append("</div>");
        	}
    		break;
    		}
            case 4:{
            	
            	
            	if(token!="")
	    		{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-delete\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
            		str.append("</div>");
	    		}
            	else
            	{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-delete\"/>");
            		str.append("</div>");
            	}
            	
            	 
                
         		
            	str.append("<table class=\"tabledata\"><thead><tr><th>Select</th><th>Pid</th><th>Title</th><th>Author(s)</th><th>Type</th><th>Date</th><th>State</th></tr></thead>");
            	
        		for(int i=0; i<results.length; i++)
        		{
        			String pid = results[i].getPid();
        			str.append("<tr><td><input type=\"checkbox\" name=\"checkedPids\" value=\""+pid+"\"/></td>");
        			str.append("<td><a href=\""+path+"/DisplayMarcxmlAsFormServlet?pid="+pid+"\">"+pid+"</a></td>");
        			try{
            			str.append("<td>"+results[i].getTitle(0)+"</td>");
            			}
            			catch(Exception E)
            			{
            			str.append("<td></td>");
            			}
            			try{
            				str.append("<td>"+results[i].getCreator(0)+"</td>");
                			}
                			catch(Exception E)
                			{
                			str.append("<td></td>");
                			}
                			try{
                				str.append("<td>"+results[i].getType(0)+"</td>");
                    			}
                    			catch(Exception E)
                    			{
                    			str.append("<td></td>");
                    			}
                    			try{
                    				str.append("<td>"+results[i].getDate(0)+"</td>");
                        			}
                        			catch(Exception E)
                        			{
                        			str.append("<td></td>");
                        			}
            			str.append("<td>"+results[i].getState()+"</td></tr>");
        			
        		}
        		str.append("</table>");	
        		
        		if(token!="")
	    		{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-delete\"/> <input type=\"submit\" name =\"submit\" class=\"button\" value=\"next\"/>");
            		str.append("</div>");
	    		}
            	else
            	{
            		str.append("<div id=\"data\">");
                    str.append("<input type=\"submit\" name =\"submit\" class=\"button\" value=\"batch-delete\"/>");
            		str.append("</div>");
            	}
        		break;
            }
            
            }
			
	        }
			else
			{
				str.append("The Search Failed to Retrieve any Results. Try again!");
			}
			
		}
		else if (buttonValue.compareToIgnoreCase("activate")==0)
		{
			heading="Activated Datastreams Report";
			try
			{
			
				String [] paramNext=request.getParameterValues("checkedPids");
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
				String[] result = paramNext[i].split("\\|");
				
				String timestamp=fed.setDatastreamState(result[0], result[1],"A", "log");
	    		str.append("<div class=\"ack\">The Datastream "+paramNext[i]+" successfully Activated with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				str.append("<div class=\"error\">"+"Nothing selected Please go back and select Datastreams to be processed !"+"</div>");
			}
			try
			{
			//str.append("you have pressed activate");
				String [] paramNext2=request.getParameterValues("prevSelection");
			
			for(int i=0; i<paramNext2.length; i++) {
	            //str.append("<LI>" + paramNext2[i]);
				//you have selected PID's
				try
				{
					String[] result = paramNext2[i].split("\\|");
					String timestamp=fed.setDatastreamState(result[0], result[1],"A", "log");
					str.append("<div class=\"ack\">The Datastream "+paramNext2[i]+" successfully Activated with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				
			}
		}
		else if (buttonValue.compareToIgnoreCase("de-activate")==0)
		{
			heading="De-Activated Datastreams Report";
			try
			{
			
				String [] paramNext=request.getParameterValues("checkedPids");
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
				String[] result = paramNext[i].split("\\|");
				//str.append("<div class=\"ack\">result[0] "+result[0]+" result[1] "+result[1]+"</div>");
				
				String timestamp=fed.setDatastreamState(result[0], result[1],"I", "log");
	    		str.append("<div class=\"ack\">The Datastream "+paramNext[i]+" successfully De-Activated with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				str.append("<div class=\"error\">"+"Nothing selected Please go back and select Datastreams to be processed !"+"</div>");
			}
			try
			{
			//str.append("you have pressed activate");
				String [] paramNext2=request.getParameterValues("prevSelection");
			
			for(int i=0; i<paramNext2.length; i++) {
	            //str.append("<LI>" + paramNext2[i]);
				//you have selected PID's
				try
				{
					String[] result = paramNext2[i].split("\\|");
					String timestamp=fed.setDatastreamState(result[0], result[1],"A", "log");
					str.append("<div class=\"ack\">The Datastream "+paramNext2[i]+" successfully De-Activated with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				
			}
		}
		else if (buttonValue.compareToIgnoreCase("batch-edit")==0)
		{
			heading="batch-edit Object Selection";
			StringBuffer tempB = new StringBuffer();
			int count=0;
			try
			{
			String [] paramNext=request.getParameterValues("checkedPids");
			
			for(int i=0; i<paramNext.length; i++) {
	            str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				count++;
				tempB.append("<input type=hidden name=\"selectedPids\" value=\""+paramNext[i]+"\">");
	          }
			}
			catch(Exception E)
			{
				
			}
			try
			{
			//str.append("you have pressed activate");
			String [] paramNext2=request.getParameterValues("prevSelection");
			
			for(int i=0; i<paramNext2.length; i++) {
	            str.append("<LI>" + paramNext2[i]);
				//you have selected PID's
				count++;
				tempB.append("<input type=hidden name=\"selectedPids\" value=\""+paramNext2[i]+"\">");
		         
	          }
			}
			catch(Exception E)
			{
				
			}
			if(count>0)
			{
				str.append(getHTML(tempB.toString()));
			}
			else
			{
				str.append("<div class=\"error\">"+"Nothing selected Please go back and select records to be processed !"+"</div>");
				
			}
			
		}
		else if(buttonValue.compareToIgnoreCase("batch-delete")==0)
		{
			heading="batch-delete Process Report";
			
			
			
			
			
			try
			{
			
				String [] paramNext=request.getParameterValues("checkedPids");
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
				String timestamp=fed.purgeObject(paramNext[i],"log");
	    		str.append("<div class=\"ack\">The Object "+paramNext[i]+" successfully deleted with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				str.append("<div class=\"error\">"+"Nothing selected Please go back and select records to be processed !"+"</div>");
			}
			try
			{
			//str.append("you have pressed activate");
				String [] paramNext2=request.getParameterValues("prevSelection");
			
			for(int i=0; i<paramNext2.length; i++) {
	            //str.append("<LI>" + paramNext2[i]);
				//you have selected PID's
				try
				{
				String timestamp=fed.purgeObject(paramNext2[i],"log");
				str.append("<div class=\"ack\">The Object "+paramNext2[i]+" successfully deleted with acknowledged timestamp "+timestamp+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				
			}
		}
		else if(buttonValue.compareToIgnoreCase("Replace")==0)
		{
			heading="batch-Edit Processing Report";
			
			try
			{
			
				String [] paramNext=request.getParameterValues("selectedPids");
				String [] Source=request.getParameterValues("source");
				String [] destination=request.getParameterValues("destination");
				ServletContext context = getServletContext();
		        String realPath = context.getRealPath("/WEB-INF/stylesheet");
		        String propertyPath = realPath+"/marc2dc.xslt"; 
				str.append("<div class=\"ack\">Replacing "+Source[0]+" with "+destination[0]+" </div>");
				
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
					
				str.append("<div class=\"ack\">INFO: "+fed.searchAndReplaceInDatastream(paramNext[i], Source[0], destination[0], "edited using Fabulous version 3", propertyPath)+"</div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				}
		}
		else if(buttonValue.compareToIgnoreCase("Add Datafield")==0)
		{
			heading="batch-Edit (Add Datafield) Processing Report";
			
			try
			{
				String [] datafield=request.getParameterValues("datafieldTag_1");
				String [] ind1=request.getParameterValues("datafieldInd1_1");
				String [] ind2=request.getParameterValues("datafieldInd2_1");
				ArrayList subfields = new ArrayList();
				ServletContext context = getServletContext();
		        String realPath = context.getRealPath("/WEB-INF/stylesheet");
		        String propertyPath = realPath+"/marc2dc.xslt"; 
				
		      //  str.append("<div class=\"error\"> Datafield: "+datafield[0]+" ind1:"+ind1[0]+" ind2:"+ind2[0]+"</div>");
				
				
				Enumeration paramNames = request.getParameterNames();
			    while(paramNames.hasMoreElements()) {
			    	String paramName = (String)paramNames.nextElement();
			    	if (paramName.contains("subfield"))
			    	{
			    		try
			    		{
			    		String code = request.getParameterValues(paramName)[0];
			    		String value=request.getParameterValues("subvalue_1_"+paramName.split("_")[2])[0];
			    		subfields.add(code+"|"+value);
			    		}
			    		catch (Exception E)
			    		{
			    			
			    		}
			    		
			    		// str.append("<div class=\"error\"> subfield: "+code+"|"+value+"</div>");
							
			    	}
			    	
				   // String[] paramValues = request.getParameterValues(paramName);
			    }
			    
			
				String [] paramNext=request.getParameterValues("selectedPids");
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
				
	    		//str.append("<div class=\"ack\">The Object "+paramNext[i]+" successfully selected for Editing </div>");
				str.append("<div class=\"ack\">INFO: "+fed.addDatafieldInDatastream(paramNext[i], datafield[0], ind1[0], ind2[0],subfields, "edited using Fabulous version 3", propertyPath)+"</div>");
					
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				str.append("<div class=\"error\">"+Excp.toString()+"</div>");
				}
			
		}
		else if(buttonValue.compareToIgnoreCase("Delete Datafield")==0)
		{
			heading="batch-Edit (Delete Datafield) Processing Report";
			
			try
			{
				String [] tag=request.getParameterValues("dataFieldtag");
				
				ServletContext context = getServletContext();
		        String realPath = context.getRealPath("/WEB-INF/stylesheet");
		        String propertyPath = realPath+"/marc2dc.xslt"; 
				str.append("<div class=\"ack\">Deleting Marc Datafield "+tag[0]+"</div>");
				
				String [] paramNext=request.getParameterValues("selectedPids");
			for(int i=0; i<paramNext.length; i++) {
	            //str.append("<LI>" + paramNext[i]);
				//you have selected PID's
				try
				{
					str.append("<div class=\"ack\">INFO: "+fed.RemoveDatafieldInDatastream(paramNext[i], tag[0], "edited using Fabulous version 3", propertyPath)+"</div>");
					
	    		//str.append("<div class=\"ack\">The Object "+paramNext[i]+" successfully selected for Editing </div>");
				}
				catch(FabulousException E)
				{
					str.append("<div class=\"error\">"+E.toString()+"</div>");
				}
	          }
			}
			catch(Exception Excp)
			{
				}
		}
		else
		{
			str.append("you have pressed nothing");
			
		}
		output=str.toString();
	}
        catch(Exception ex)
        {
        	output=ex.getMessage();
        }
        
        RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
        request.setAttribute("title", title);
       // request.setAttribute("heading", "Search Results for Term \""+searchString+"\"");
        request.setAttribute("heading", heading);
        request.setAttribute("body", output);
	    rd.forward(request, response);
	} 
	

	private static String getHTML(String pidsAsHidden)
	 {
		 StringBuffer tempString= new StringBuffer();
		 tempString.append("<form action=\"DisplaySearchResults\" method=\"post\" >");
		  
	       tempString.append(pidsAsHidden);
	       tempString.append("<div id =\"main\"><br/>");
	       tempString.append("<br/>");
		   tempString.append("<fieldset>");
	  tempString.append("<legend>Select the functionality:</legend>");
	   tempString.append("<table class=\"formdata_preview\" width=\"100%\" border=0>");
	       tempString.append("<tbody>");

	         tempString.append("<tr>");
	           tempString.append("<td valign=top width=\"25%\"> <strong>*</strong> Function Type: </td>");
	           tempString.append("<td>");
	             tempString.append("<select onchange=\"hideAll(this);\" size=1 name=function_type>");
	               tempString.append("<option value=\"\">Select Function ...</option>");
	               tempString.append("<option value=\"Edit\">Edit Datastream(Search and Replace)</option>");
	               tempString.append("<option value=\"Add\">Add Datafield</option>");
	               tempString.append("<option value=\"Delete\">Delete Datafield</option>");
	            tempString.append("</select>");
	           tempString.append("</td>");
	         tempString.append("</tr>");
	       tempString.append("</tbody>");
	   tempString.append("</table>");
	  tempString.append("</fieldset>");

	 tempString.append("<br/>");

//edit functionality
	 tempString.append("<DIV id=\"Edit\" style=\"display:none\">");
	  tempString.append("<FIELDSET><LEGEND>Additional information - About the Edit Functionality </LEGEND>");
	  tempString.append("<TABLE width=\"100%\" border=0>");
	   tempString.append("<TBODY>");

	   tempString.append("<tr>");
	     tempString.append("<td width=\"25%\">Find What:</td>");
	     tempString.append("<td><input name=source></td>");
	   tempString.append("</tr>");
	   tempString.append("<tr>");
	     tempString.append("<td width=\"25%\">Replace with:</td>");
	     tempString.append("<td><input name=destination></td>");
	   tempString.append("</tr>");

	   tempString.append("</TBODY>");
	  tempString.append("</TABLE>");
	   
	   tempString.append("<tr><input type=\"submit\" class= \"button\" name=\"submit\" value=\"Replace\" /> </p>  </tr>");
	  

	  tempString.append("</FIELDSET>");
	  tempString.append("<br>");
	 tempString.append("</DIV>");



	    
	//Add functionality
	 tempString.append("<DIV id=\"Add\" style=\"display:none\">");
	 tempString.append("<FIELDSET><LEGEND>Additional information - About the Add functionality </LEGEND>");

	
	 
	 tempString.append("<table class=\"tabledata\">");
	 tempString.append("<tr>");
	    tempString.append("<td STYLE=\"color: #99CCFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #99CCFF;\">P</td>");
	    tempString.append("<td>Leader</td>");
	    tempString.append("<td STYLE=\"color: #FF6600; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF6600;\">P</td>");
	    tempString.append("<td>ControlField tag</td>");
	    tempString.append("<td STYLE=\"color: #9acd32; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;\">P</td>");
	    tempString.append("<td>DataField tag</td>");
	    tempString.append("<td STYLE=\"color: #FF9933; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF9933;\">P</td>");
	    tempString.append("<td>Indicator 1</td>");
	    tempString.append("<td STYLE=\"color: #FFCC99; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FFCC99;\">P</td>");
	    tempString.append("<td>Indicator 2</td>");
	    tempString.append("<td STYLE=\"color: #CC99CC; font-family: Verdana; font-weight: bold; font-size: 12px; background-color:  #CC99CC;\">P</td>");
	    tempString.append("<td>Subfield</td>");
	    tempString.append("<td STYLE=\"color: #CCCCCC; font-family: Verdana; font-weight: bold; font-size: 12px; background-color:  #CCCCCC;\">P</td>");
	    tempString.append("<td>Value</td>");
	    tempString.append("</tr>");
	 tempString.append("</table>");
	 tempString.append("<hr size=\"4\"/>");



	 tempString.append("<table class=\"tabledata\" cellpadding=\"5\" id=\"tblData\">");
	    tempString.append("<tr>");
	       tempString.append("<td><input type=\"text\" STYLE=\"color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;\" name=\"datafieldTag_1\" value=\"\" size=\"2\"> </td>");
	       tempString.append("<td>");
	          tempString.append("<select name=\"datafieldInd1_1\" STYLE=\"color: black; font-family: Verdana;font-weight: bold; font-size: 12px;background-color: #FF9933;\">");
	             tempString.append("<option value=\" \">_</option>");
	             tempString.append("<option value=\"0\">0</option>");
	             tempString.append("<option value=\"1\">1</option>");
	             tempString.append("<option value=\"2\">2</option>");
	             tempString.append("<option value=\"3\">3</option>");
	             tempString.append("<option value=\"4\">4</option>");
	             tempString.append("<option value=\"5\">5</option>");
	             tempString.append("<option value=\"6\">6</option>");
	             tempString.append("<option value=\"7\">7</option>");
	             tempString.append("<option value=\"8\">8</option>");
	             tempString.append("<option value=\"9\">9</option>");
	          tempString.append("</select>");
	       tempString.append("</td>");
	       tempString.append("<td>");
	          tempString.append("<select name=\"datafieldInd2_1\" STYLE=\"color: black; font-family: Verdana;font-weight: bold; font-size: 12px;background-color: #FFCC99;\">");
	          tempString.append("<option value=\" \">_</option>");
	             tempString.append("<option value=\"0\">0</option>");
	             tempString.append("<option value=\"1\">1</option>");
	             tempString.append("<option value=\"2\">2</option>");
	             tempString.append("<option value=\"3\">3</option>");
	             tempString.append("<option value=\"4\">4</option>");
	             tempString.append("<option value=\"5\">5</option>");
	             tempString.append("<option value=\"6\">6</option>");
	             tempString.append("<option value=\"7\">7</option>");
	             tempString.append("<option value=\"8\">8</option>");
	             tempString.append("<option value=\"9\">9</option>");
	          tempString.append("</select>");
	       tempString.append("</td>");
	       tempString.append("<td><table class=\"tabledataS\"  id=\"tblSub1\" cellpadding=\"2\"> <tr>");
	             tempString.append("<td><input type=\"text\" STYLE=\"color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CC99CC;\" name=\"subfield_1_1\" value=\"\" size=\"1\"> </td>");
	             tempString.append("<td><textarea rows=\"2\" cols=\"80\"  STYLE=\"color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CCCCCC;\" name=\"subvalue_1_1\"></textarea></td>");
	          tempString.append("</tr></table> </td>");
	       tempString.append("<td><input type=\"button\" class=\"buttonS\" value=\"+\" title=\"Add Subfield\" onclick=\"addSubfieldTest2(1);\" > <input type=\"button\" class=\"buttonS\" value=\"-\" title=\"Remove Subfield\" onclick=\"removeSubField(1);\" > </td>");
	    tempString.append("</tr></table>");
	 
	   
	     
	      tempString.append("<input type=\"submit\" class= \"button\" name=\"submit\" value=\"Add Datafield\" />");
	 

	   tempString.append("</FIELDSET>");
	  tempString.append("<br>");
	 tempString.append("</DIV>");

	//delete functionality

	 tempString.append("<DIV id=\"Delete\" style=\"display:none\">");
	 tempString.append("<FIELDSET>");
	  tempString.append("<LEGEND>Additional information - About the Delete Functionality </LEGEND>");
	  tempString.append("<TABLE width=\"100%\" border=0>");
	   tempString.append("<TBODY>");

	   tempString.append("<table class=\"formdata_preview\" width=\"100%\" id=\"creator\">");
	   tempString.append("<tbody>");
	  
	   tempString.append("<tr >");
	     tempString.append("<td colspan=\"8\"> Datafield (<i id=\"count_label\">First</i>)</td>");
	   tempString.append("</tr>");
	   tempString.append("<tr>");
	    tempString.append(" <td>&nbsp;&nbsp;&nbsp; </td>");
	    tempString.append(" <td> <strong>*</strong> Datafield tag:</td>");
	    tempString.append(" <td><input name=dataFieldtag > </td>");

	   tempString.append("</tr>");

	   tempString.append("</tbody>");
	  tempString.append("</table>");

	  
	   tempString.append("<input type=\"submit\" class =\"button\" name=\"submit\" value=\"Delete Datafield\" /> </p>");
	  
	  tempString.append("</FIELDSET>");
	  tempString.append("<br>");
	 tempString.append("</DIV>");

	 tempString.append("</div></form>");
	 
	 return tempString.toString();
	 }

}  	  
 
 