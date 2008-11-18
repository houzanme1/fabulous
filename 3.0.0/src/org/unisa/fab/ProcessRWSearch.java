/* 
 * Fabulous - Fedora/Arrow Batch Utility With Lots of User services
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
package org.unisa.fab;

import java.io.IOException;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class for Servlet: ValuesSubmitted
 *
 */
 public class ProcessRWSearch extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
	public static Flag flag=new Flag(false);
   	Counter t;
   
   
    /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public ProcessRWSearch() {
		super();
	}   	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	} 
	
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
			
			response.setContentType("charset=UTF-8");
			String buttonValue = request.getParameter("submit");
			
			String value="";
			String error="";
			try
			{
			if(flag.getflag())
			{
				error="An instance of Background service already running! Try again later";
			}
			else
			{
			
				if(buttonValue.compareToIgnoreCase("Modify Metadata")==0)
		        {
		        	try
					{
					
						flag.setflag(true);
						t = new Counter(flag);
						t.start();
						value="Successfully started the Modify Metadata process in the Background";
					
					}
					catch(Exception E)
					{
						error= "Failed Modifying Metadata "+E.toString();
					}
			
		        }
		        else if(buttonValue.compareToIgnoreCase("Remove Datafield")==0)
		        {
		        	try
					{
					
						flag.setflag(true);
						t = new Counter(flag);
						t.start();
						value="Successfully started Remove Datafield process in the Background";
						
					
					}
					catch(Exception E)
					{
						error= "Failed removing Datafield from Metadata "+E.toString();
					}
		        }
		        else if(buttonValue.compareToIgnoreCase("Add Datafield")==0)
		        {
		        	try
					{
					
						flag.setflag(true);
						t = new Counter(flag);
						t.start();
						value="Successfully started Adding Datafield process in the Background";
						
					}
					
					catch(Exception E)
					{
						error= "Failed Adding Datafield to Metadata "+E.toString();
					}
			
		        }
		        else if(buttonValue.compareToIgnoreCase("Update Properties")==0)
		        {
		        	try
					{
					
						flag.setflag(true);
						t = new Counter(flag);
						t.start();
						value="Successfully started Update Datastream Properties process in the Background";
						
					
					}
					catch(Exception E)
					{
						error= "Failed Upadating datastream properties "+E.toString();
					}
		        }
		        else if(buttonValue.compareToIgnoreCase("Modify Objects")==0)
		        {
		        	try
					{
					
						flag.setflag(true);
						t = new Counter(flag);
						t.start();
						value="Successfully started the Modify Objects process in the Background";
						
					}
					catch(Exception E)
					{
						error= "Failed Modifying Object properties "+E.toString();
					}
			
		        }
		        else if(buttonValue.compareToIgnoreCase("STOP")==0)
		        {
		        		t.stopThread();
		        		value="Successfully stopped the Background process"; 
				
		        }
		        else
		        {
		        	error= "nothing submitted! ";
		        }
			}
	        
			}
			catch(Exception E)
			{
				error="Failed Processing Repository Wide Process! "+E.toString();
				value=buttonValue;
			}

			RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
			
			request.setAttribute("title", "Background Process");
			request.setAttribute("heading", "Repository Wide Process Report");
			request.setAttribute("body", value+"<div class=\"error\">"+error+"</div>");
	        rd.forward(request,response);
	}   	  	 
	
	   
	
}
 
 
 class Counter extends Thread {
		/* This class simply runs a thread to count to 50 */
	 Flag flag;
	 private volatile Thread blinker;
	 
	 public Counter(Flag flag)
	 {
		 this.flag=flag;
	 }
	 public void stopThread()
	 {
		 Thread tmpBlinker=blinker;
		 blinker=null;
		 if(tmpBlinker!=null)
		 {
			 tmpBlinker.interrupt();
		 }
		 flag.setflag(false);
	 }
	 
	 public void run() 
	 {
		  Thread thisThread = Thread.currentThread();
		  while(blinker==thisThread)
		  {
		 try          
		 {
		    sleep(120);
		    flag.setflag(false);
		  } 
		  catch (InterruptedException e) 
		   { }
		  }
		          
		      
	 }    
	 }

class Flag{
	 
	 private boolean flag;
	 
	 public Flag(boolean flag)
	 {
		 this.flag=flag;
	 }
	 public boolean getflag()
	 {
		 return flag;
	 }
	 
	 public void setflag(boolean flag)
	 {
		 this.flag=flag;
	 }
	 
		       
	 }