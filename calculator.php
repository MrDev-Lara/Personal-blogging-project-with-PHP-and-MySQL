.elementor-inner{
width:100vh;
  height:100vw;
  overflow-x:hidden;
  overflow-y: scroll;
  transform: rotate(-90deg) translateX(-100vh);
  transform-origin: top left; 
  position:absolute;
  scrollbar-width:none;
  -ms-overflow-style:none;
}

.elementor-section-wrap{
  transform: rotate(90deg) translateY(-100vh);
  transform-origin: top left; 
  display:flex;
  flex-direction: row; 
  width: 600vw;
}

.section{ width:100vw; height:10vh}
::-webkit-scrollbar{
display:none;
} 

@media screen and (min-width:992px){
.elementor-inner{
width:100vh;
  height:100vw;
  overflow-x:hidden;
  overflow-y: scroll;
  transform: rotate(-90deg) translateX(-100vh);
  transform-origin: top left; 
  position:absolute;
  scrollbar-width:none;
  -ms-overflow-style:none;
}

.elementor-section-wrap{
  transform: rotate(90deg) translateY(-100vh);
  transform-origin: top left; 
  display:flex;
  flex-direction: row; 
  
  width: 600vw;
}

.section{ width:100vw; height:10vh}

::-webkit-scrollbar{
display:none
}

} 