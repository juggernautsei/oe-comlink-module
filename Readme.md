# Comlink Services Module for OpenEMR
This is a simple module project that developers can clone and use to create their own custom modules inside
the OpenEMR codebase.  These modules leverage the oe-module-install-plugin which installs the custom module
into the OpenEMR custom module installation folder.

## Getting Started
You can start by cloning the project.   Or you can download a copy of this project and unzip it into this folder 
```
openemr/interface/custom_modules
```

### Installing Module
To install the module, after copying the module to the above directory. From the main menu in the program select Modules. Go to unregistered modules and you should find
the Comlink module listed. Select register and follow the rest of the instructions to install and activate the module.


At that point you can run the install command
```
composer require adunsulag/oe-module-custom-skeleton
```

