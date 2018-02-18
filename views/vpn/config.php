##############################################
# Sample client-side OpenVPN 2.0 config file #
# for connecting to multi-client server.     #
#                                            #
# This configuration can be used by multiple #
# clients, however each client should have   #
# its own cert and key files.                #
#                                            #
# On Windows, you might want to rename this  #
# file so it has a .ovpn extension           #
##############################################

# Specify that we are a client and that we
# will be pulling certain config file directives
# from the server.
client

# Use the same setting as you are using on
# the server.
# On most systems, the VPN will not function
# unless you partially or fully disable
# the firewall for the TUN/TAP interface.
;dev tap
dev tun

# Windows needs the TAP-Win32 adapter name
# from the Network Connections panel
# if you have more than one.  On XP SP2,
# you may need to disable the firewall
# for the TAP adapter.
;dev-node MyTap

# Are we connecting to a TCP or
# UDP server?  Use the same setting as
# on the server.
proto tcp
;proto udp

# The hostname/IP and port of the server.
# You can have multiple remote entries
# to load balance between the servers.
remote beta.csie.io 25
;remote my-server-1 1194
;remote my-server-2 1194

# Choose a random host from the remote
# list for load-balancing.  Otherwise
# try hosts in the order specified.
;remote-random

# Keep trying indefinitely to resolve the
# host name of the OpenVPN server.  Very useful
# on machines which are not permanently connected
# to the internet such as laptops.
resolv-retry infinite

# Most clients don't need to bind to
# a specific local port number.
nobind

# Downgrade privileges after initialization (non-Windows only)
;user nobody
;group nobody

# Try to preserve some state across restarts.
persist-key
persist-tun

# If you are connecting through an
# HTTP proxy to reach the actual OpenVPN
# server, put the proxy server/IP and
# port number here.  See the man page
# if your proxy server requires
# authentication.
;http-proxy-retry # retry on connection failures
;http-proxy [proxy server] [proxy port #]

# Wireless networks often produce a lot
# of duplicate packets.  Set this flag
# to silence duplicate packet warnings.
;mute-replay-warnings

# SSL/TLS parms.
# See the server config file for more
# description.  It's best to use
# a separate .crt/.key file pair
# for each client.  A single ca
# file can be used for all clients.
;ca ca.crt
;cert client.crt
;key client.key

# Verify server certificate by checking that the
# certicate has the correct key usage set.
# This is an important precaution to protect against
# a potential attack discussed here:
#  http://openvpn.net/howto.html#mitm
#
# To use this feature, you will need to generate
# your server certificates with the keyUsage set to
#   digitalSignature, keyEncipherment
# and the extendedKeyUsage to
#   serverAuth
# EasyRSA can do this for you.
remote-cert-tls server

# If a tls-auth key is used on the server
# then every client must also have the key.
tls-auth [inline] 1
key-direction 1

# Select a cryptographic cipher.
# If the cipher option is used on the server
# then you must also specify it here.
# Note that v2.4 client/server will automatically
# negotiate AES-256-GCM in TLS mode.
# See also the ncp-cipher option in the manpage
cipher AES-256-CBC

# Enable compression on the VPN link.
# Don't enable this unless it is also
# enabled in the server config file.
#comp-lzo

# Set log file verbosity.
verb 3

# Silence repeating messages
;mute 20

auth-user-pass

<ca>
-----BEGIN CERTIFICATE-----
MIIDODCCAiCgAwIBAgIJAP7YJ4NEFEKMMA0GCSqGSIb3DQEBCwUAMBcxFTATBgNV
BAMMDGJldGEuY3NpZS5pbzAeFw0xNzEyMjIwODE2NDhaFw0yNzEyMjAwODE2NDha
MBcxFTATBgNVBAMMDGJldGEuY3NpZS5pbzCCASIwDQYJKoZIhvcNAQEBBQADggEP
ADCCAQoCggEBALSmbZ5K4jUX8ZKKzLDfgPJeSnquHgWn4KwPApGk+1U6zAKGpI9a
utoN5v21gzKtVRInkHFAgcNE3V6xaN1YXPQvW1Cn6MEh1MvlMJaMm7FMkWbQmp9x
yEHShyU+g+l3KV4KiMrXQQyAxUf2G0aFqr+xiB/8kTvC99wU3fGwKf4+K5Qo246w
FFz4DuL6fLXWyJZr0c4w5AoMrB1RuTvnyKGfQQaurhuNV7I4F5up1VbaQNyJetDm
/bcGh3rrjMiOtSsVYfOIigttlgmswGcrN9dZCeu+/WfdyNcDlaJeMxTKwtNUfoq/
FVShgWb74le0OP62cQzrxju3okEeqTzBQL0CAwEAAaOBhjCBgzAdBgNVHQ4EFgQU
IDSWnIPuxR7IDdWdbp4EurowxyMwRwYDVR0jBEAwPoAUIDSWnIPuxR7IDdWdbp4E
urowxyOhG6QZMBcxFTATBgNVBAMMDGJldGEuY3NpZS5pb4IJAP7YJ4NEFEKMMAwG
A1UdEwQFMAMBAf8wCwYDVR0PBAQDAgEGMA0GCSqGSIb3DQEBCwUAA4IBAQBoEEXd
HAkvNIkWIUzMS1ytWBlX9JHiWixl8GxEUXyQTKkIlAGbNwfz0YrzVOun0IPPFqNi
WdSVFc2pZQnLvU+/niXHDgkvCZw1IdY4yZ9/UEGq6EJoMdKesp4eeF9OGCUkK1UM
atTgHwUt8jBDqHOb0I57IQ2A/GH8yKMCBQpkMv+1GMTKsrmeHexMedi71jJl/emW
CqZfFsR6qvWH9zrwAUrWputtvgeuJTgrJd+II82y5wU735L/mIQUOvSHuhqinA0H
FvjbafRHqAR9XzTf3EHpcBnH/MajQGZE8FGDdoLZN059p29y4+/jRd5mcZZILoK9
1BnvSbNjYGtyKyZT
-----END CERTIFICATE-----
</ca>

; <cert>
; *** CERT ***
; </cert>
;
; <key>
; *** KEY ***
; </key>

<tls-auth>
#
# 2048 bit OpenVPN static key
#
-----BEGIN OpenVPN Static key V1-----
119993f95578c6b57560336a6910708f
e81f9f5d422caf7583dc97e7c026633d
7bfaf59d6679fabd304b888b9913d1aa
bc48d933efa35b6c34e14b7737054054
381e25b55deb2e11ac98472af45c2740
0fd3a92b0ad0b00b952d786090008579
7132430ac3b8f4551ab71b95ceeb833b
03d32d31c3359f7548e6042ad04dddb9
20f8bbd75c9304ecf822ab0a60ab4e56
63e44f899215f50bbf64330240aec40b
ad5a102876b944397ae82df68e803915
0b58b29eb13be34fcb0776467a34f9f2
534b1e78d008daf07c8027730451bf49
0923774d50607f7edf7cb32eba5af5bc
f02daa19f1aff235a1afa77c858cf825
87ed734529795ac9a45014d4646b70b7
-----END OpenVPN Static key V1-----
</tls-auth>
