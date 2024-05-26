const login= require("./loginSchema");
const express=require("express")

const app=express();


app.post("/login",(req,res)=>{
 const {name,email,password}=req.body;

 const newUser=login.create({
    name,email,password 
 })
 res.status(200).json({message:"Successfully Signup"})

})