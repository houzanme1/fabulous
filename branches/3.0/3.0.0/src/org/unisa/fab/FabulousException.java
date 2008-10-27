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
