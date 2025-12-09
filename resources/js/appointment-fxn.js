
        function selectTimeSlot(slot) {
            document.querySelectorAll('.appointment-slot').forEach(s => {
                s.classList.remove('bg-primary', 'text-black');
                s.classList.add('bg-[#309983]/10');
            });
            slot.classList.remove('bg-gray-800');
            slot.classList.add('bg-primary', 'text-black');
        }
