/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package discussion_thread;

/**
 *
 * @author user
 */
public class Post implements Cloneable {    
    private String text;
    private String time;
    private String username;    
    
    public String getText() {
        return text;
    }
            
    public String getTime() {
        return time;
    }
        
    public String getUsername() {
        return username;
    }
    
    public void setText(String text) {
        this.text = text;
    }
    
    public void addText(String text) {
        this.text += text;
    }

    public void setUsername(String username) {
        this.username = username;
    }
        
    public void setTime(String time) {
        this.time = time;
    }
    
    @Override   // Code from http://howtodoinjava.com/core-java/cloning/a-guide-to-object-cloning-in-java/
    protected Object clone() throws CloneNotSupportedException {
        return super.clone();
    }
    
    public String display() {       
        return text + time + username;
    }
}
