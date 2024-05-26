import mongoose from 'mongoose';

const loginSchema=new mongoose.Schema({

name:{
    type:String,
    required:true
}
,
email:{
    type:String,
    required:true
},
password:{
    type:String,
    required:true
}
})

const login= new mongoose.model("login",loginSchema);

module.exports={login}

