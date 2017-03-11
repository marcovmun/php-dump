require 'yaml'
Vagrant.configure(2) do |config|
	config.vm.box = "ubuntu/xenial64"
	config.vm.define "phpdump_development_box" do |development_box|
	end

	config.vm.provider "virtualbox" do |v|
		v.customize ["modifyvm", :id, "--uartmode1", "disconnected"]
		v.customize ["modifyvm", :id, "--memory", "1024"]
	end

    config.vm.network "public_network",
    use_dhcp_assigned_default_route: true

	config.ssh.username = "ubuntu"
	config.ssh.forward_agent = true

	config.vm.synced_folder "../", "/var/phpdump/repositories", mount_options: (/cygwin|mswin|mingw|bccwin|wince|emx/ =~ RUBY_PLATFORM) != nil ? ["dmode=775,fmode=774"] : [], owner: 1001, group: 33

	config.vm.provision :ansible_local do |ansible|
		ansible.playbook = "ansible/site.yml"
		ansible.groups = {
			"webservers" => ["phpdump_development_box"],
			"development" => ["phpdump_development_box"]
		}
	end
end
