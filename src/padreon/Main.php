<?php

namespace padreon; //nama folder setelah src

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

    public function onLoad(){
        $this->getLogger()->info("Plugin sedang di load oleh server");
    }
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        //mendaftarkan event karena plugin memakai event PLayerJoinEvent
        $this->getLogger()->info("Plugin telah aktif");
    }
    public function onDisable(){
        $this->getLogger()->info("Plugin telah mati");
    }
    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer(); //event untuk medapatkan player yg join
        $name = $player->getName(); //mendapatkan nama dari player tersebut
        $this->getServer()->broadcastMessage(TextFormat::GREEN . "$name Joined The server Adreon Network");
        //diatas adalah broadcast jdi semua player online yg ada di server akan dikirim kan pesan seperti di atas
        $player->sendMessage("selamat datang di adreon network $name");
        //diatas adalah pengiriman pesan yg hanya dikirim ke player yg join saat itu;
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()){
            /** Nama Commandnya adalah /test */
            case "test":
                $sender->sendMessage("Saya menggunakan command /test");
                #dan akan mengirim pesan Saya menggunakan command /test
            break; //setelah mengisi command dari /test setelah itu di break

            case "test1":
                if (!$sender instanceof Player){
                    //tanda seru di kata $sender mengartikan bukan, berarti jika $sender bukanlah player maka isi nya dibawah ini
                    $sender->sendMessage(TextFormat::RED . "Silahkan memasukan command ini didalam game karena kamu memasukan command nya pada console ");
                    return true;
                    /**
                     * saat mengakhiri dari command gunakan return true agar code di masuk ketahap selanjutnya
                     * yaitu code dibawah ini, namun ada saatnya juga code tidak perlu di return karna
                     * masuk ketahap selanjutnya.
                     */
                    //
                }
                if ($sender instanceof Player){
                    if ($sender->getName() == "padreon"){
                        $sender->sendMessage("code ini dikhusukan untuk nick padreon");
                        /**
                         * tidak perlu di return agar command nya masuk ketahap berikut yaitu tahap memasukan item ke inventory
                         * tapi jika tidak mau player memasukan item ke inventory
                         * silahkan menghapus tanda pagar dibawah ini
                         */
                        #return true;

                    }
                    $id = 1;
                    $meta = 0;
                    $jumlah = 1;
                    $sender->getInventory()->addItem(Item::get($id, $meta, $jumlah));
                    $sender->sendMessage(TextFormat::GREEN . "Anda mendapatkan item dengan id $id dan jumlah nya adalah $jumlah");
                    //tidak perlu di return karena code didalam command test1 sudah berakhir,
                }

        }
        return true; //harus di return agar command yg di plugin lain tidak terganggu
    }

}
