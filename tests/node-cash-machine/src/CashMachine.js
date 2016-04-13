(function(){

	var CashMachine = function(){
		this.availableNotes = [100, 50, 20, 10];
	};

	CashMachine.prototype.withdraw = function(requested, notes){
		notes = notes || this.availableNotes.slice();


        if (requested < 0) {
            throw new Error('InvalidArgumentException');
        }

        if (requested < notes[0] && !notes[1]) {
             throw new Error('NoteUnavailableException');
        }

		if (requested == 0 || requested == null) return [];

		if (requested == notes[0]) return [requested];

		if (requested > notes[0]) {
			return [notes[0]].concat(this.withdraw(requested - notes[0], notes));
		}

		notes.shift();

		return this.withdraw(requested, notes);
	}

	module.exports = new CashMachine();
	
})();