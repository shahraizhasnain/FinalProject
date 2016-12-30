using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using SaudaMaster.Adapter;
using SaudaMaster.SharedModel;
namespace SaudaMaster.Services
{
    public class StoreServices : IStoreService
    {
        StoreAdapter storeAdapter;
        public StoreServices()
        {
            this.storeAdapter = new StoreAdapter();
        }  

        public IEnumerable<StoreViewModel> ReturnAllStore()
        {
            return storeAdapter.ReturnAllStore();
        }
    }
    public interface IStoreService
    {
        IEnumerable<StoreViewModel> ReturnAllStore();
    }
}
