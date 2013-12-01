<?php 
	
	interface PastaRepoInterface
	{
		public function cookSpaghetti();
		public function cookRigatoni();
		public function cookLasagne();
	}

	class PastaRepo implements PastaRepoInterface{
		public function cookSpaghetti()
		{
			return Pasta::where('type', '=', 'spaguetti')->get();
		}
		public function cookRigatoni()
		{
			return Pasta::where('type', '=', 'rigatoni')->get();
		}
		public function cookLasagne()
		{
			return Pasta::where('type', '=', 'lasagne')->get();
		}
	}

?>