# diadikasies-wiki-to-BPMN

# CPSV to BPMN

An extension for MediaWiki responsible for the transformation of all the necessary CPSV2.0 class pages 
to BPMN related information (e.g. wiki pages, diagrams etc.) in the diadikasies.gr platform for registering public sector services.


The module functionalities are:

-Parse wiki pages describing public services as processes from diadikasies.gr 

-Parsing supports analysing pages also enhanced with CPSV semantics (with pageforms and Semantic Media wiki extension)

-Analysis of both kind of pages (CPSV and non-CPSV based) in order to locate BPMN related information

-Whether applicable, BPM notation is produced

-BPMN info is saved as separate wiki page in MediaWIki platform (depends on user permissions and tokens created)

-BPMN is saved as a .bpmn file in a Mediawiki repository (i.e. folder)

-BPMN information is "linked" back -depends on user permissions and tokens created- to original wiki-page as follows:
	-A link to the produced .bpmn file
	-An image/diagram (of state 0) of the produced BMPN

-BPMN representation is depicted to users, through an appropriate on-line tool

-BPMN representations can be opened in another tool.

-BPMN fie can be edited and uploaded back to repository

-Manual execution as glass-box approach is supported

-Automatic execution of above steps is also supported

-Mass execution of above steps is also supported

-Module is supported as a Mediawiki extension

