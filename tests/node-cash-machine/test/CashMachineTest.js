var assert = require('chai').assert;
var expect = require('chai').expect;
var cashMachine = require('../src/CashMachine');

describe('CashMachine', function() {

	it('should return empty when null withdraw', function () {
	  assert.deepEqual([], cashMachine.withdraw(null));
	});

	it('should return empty when withdraw zero ', function () {
	  assert.deepEqual([], cashMachine.withdraw(0));
	});

	it('should withdraw one note of 10', function () {
	  assert.deepEqual([10], cashMachine.withdraw(10));
	});

	it('should withdraw one note of 20', function () {
	  assert.deepEqual([20], cashMachine.withdraw(20));
	});

	it('should withdraw one note of 20 and one of 10', function () {
	  assert.deepEqual([20, 10], cashMachine.withdraw(30));
	});

	it('should withdraw two notes of 20', function () {
	  assert.deepEqual([20, 20], cashMachine.withdraw(40));
	});

	it('should withdraw one note of 50', function () {
	  assert.deepEqual([50], cashMachine.withdraw(50));
	});

	it('should withdraw one note of 50 and one of 10', function () {
	  assert.deepEqual([50, 10], cashMachine.withdraw(60));
	});

	it('should withdraw two notes of 100, one of 50, one of 20 and one of 10', function () {
	  assert.deepEqual([100, 100, 50, 20, 10], cashMachine.withdraw(280));
	});

	it('should throw exception on invalid withdraw', function () {

		var getFn = function(param){
			return function(){
			  	cashMachine.withdraw(param);
			}
		}
	  	expect(getFn(-1)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-10)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-15)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-20)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-30)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-50)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-75)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-999)).to.throw(Error, /InvalidArgumentException/);
	  	expect(getFn(-100000)).to.throw(Error, /InvalidArgumentException/);

	});

	it('should throw exception on withdraw of unavailable note', function () {

		var getFn = function(param){
			return function(){
			  	cashMachine.withdraw(param);
			}
		}
		expect(getFn(1)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(2)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(3)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(4)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(5)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(6)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(7)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(8)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(9)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(15)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(25)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(42)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(99)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(127)).to.throw(Error, /NoteUnavailableException/);
		expect(getFn(1508)).to.throw(Error, /NoteUnavailableException/);

	});
	
});