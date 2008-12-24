To base an extension off this, add foxbase as a dependency to it and include it in using:

require_once(t3lib_extMgm::extPath('foxbase').'class.fox_febase.php');

Then extend the class, e.g.

class tx_extkey_pi1 extends fox_febase  {
 /* class code here */
}

Currently we have class fox_febase for Frontend plugin development only