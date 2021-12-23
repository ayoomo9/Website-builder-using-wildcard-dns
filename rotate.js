
<!--
   var RotatingImage1_Index = 1;

   var RotatingImage1_Images = new Array(3);
   RotatingImage1_Images[1] = "logo2.png";
   RotatingImage1_Images[2] = "logo.gif";
   RotatingImage1_Images[3] = "wapbiesitalicstyle.png";

   var RotatingImage1_URLs = new Array(2);
   RotatingImage1_URLs[1] = "";
   RotatingImage1_URLs[2] = "";

   var RotatingImage1_Targets = new Array(2);
   RotatingImage1_Targets[1] = "";
   RotatingImage1_Targets[2] = "";

   function RotatingImage1ShowNext()
   {
      RotatingImage1_Index = RotatingImage1_Index + 1;
      if (RotatingImage1_Index > 2)
         RotatingImage1_Index = 1;
      eval("document.RotatingImage1.src = RotatingImage1_Images[" + RotatingImage1_Index + "]");
      setTimeout("RotatingImage1ShowNext();", 5000);
   }

   function onRotatingImage1Click()
   {
      if (RotatingImage1_Targets[RotatingImage1_Index] == "")
      {
         targetwin = "_self";
      }
      else
      {
         targetwin = RotatingImage1_Targets[RotatingImage1_Index];
      }
      eval("window.open(url = RotatingImage1_URLs[" + RotatingImage1_Index + "],'" + targetwin +"');");
   }
// -->