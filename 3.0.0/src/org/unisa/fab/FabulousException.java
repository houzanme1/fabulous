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

public class FabulousException extends RuntimeException {
	static final long serialVersionUID = 1L;
	
	
	private String error;
	private String info;
	
	public FabulousException()
	{
	
	}

	
	public FabulousException(String error, String info)
	{
	 super (info);
	 this.error=error;
	 this.info=info;
	}
	
	public String getError()
	{
		return error;
	}
	
	public String toString()
	{
		return "<div class=\"error\"><error_text>"+this.error+"</error_text><div class=\"error_message\"><error_message>"+this.info+"</error_message></div></div>";
	}
	
	

}
